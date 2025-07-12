<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NhanVien;
use App\Models\PhongBan;
use App\Models\Vitri;
use App\Models\Notification;
use App\Models\NotificationTarget;
use App\Mail\AdminNotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function create()
    {
        $users = NhanVien::all();
        $departments = PhongBan::all();
        $positions = Vitri::all();
        return view('admin.notifications.create', compact('users', 'departments', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
            'loai' => 'required|in:mail,in-app',
            'nguoi_gui_id' => 'required|exists:nguoi_quan_tri,id',
            'users' => 'array',
            'departments' => 'array',
            'positions' => 'array',
        ]);

        $notification = Notification::create([
            'tieu_de' => $request->tieu_de,
            'noi_dung' => $request->noi_dung,
            'loai' => $request->loai,
            'nguoi_gui_id' => auth()->user()->id,
        ]);

        $targets = [];
        // Lấy danh sách id hợp lệ
        $validUserIds = NhanVien::pluck('ma_nhan_vien')->toArray();
        $userIds = [];
        $hasDepartments = $request->has('departments') && !empty($request->departments);
        $hasPositions = $request->has('positions') && !empty($request->positions);
        $hasUsers = $request->has('users') && !empty($request->users);

        // Nếu chọn cả phòng ban và vị trí: lấy nhân viên thỏa mãn cả hai (AND)
        if ($hasDepartments && $hasPositions) {
            $ids = NhanVien::whereIn('ma_phong_ban', $request->departments)
                ->whereIn('ma_vi_tri', $request->positions)
                ->pluck('ma_nhan_vien')->toArray();
            $userIds = array_merge($userIds, $ids);
        } elseif ($hasDepartments) {
            $ids = NhanVien::whereIn('ma_phong_ban', $request->departments)
                ->pluck('ma_nhan_vien')->toArray();
            $userIds = array_merge($userIds, $ids);
        } elseif ($hasPositions) {
            $ids = NhanVien::whereIn('ma_vi_tri', $request->positions)
                ->pluck('ma_nhan_vien')->toArray();
            $userIds = array_merge($userIds, $ids);
        }
        // Nếu không chọn gì: gửi cho tất cả nhân viên
        if (!$hasDepartments && !$hasPositions && !$hasUsers) {
            $userIds = NhanVien::pluck('ma_nhan_vien')->toArray();
        }
        // Lấy user từ chọn trực tiếp
        if ($hasUsers) {
            foreach ($request->users as $userId) {
                if (in_array($userId, $validUserIds)) {
                    $userIds[] = $userId;
                }
            }
        }
        // Loại bỏ trùng lặp
        $userIds = array_unique($userIds);
        // Tạo targets
        $targets = [];
        foreach ($userIds as $userId) {
            $targets[] = [
                'notification_id' => $notification->id,
                'ma_nhan_vien' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if (!empty($targets)) {
            NotificationTarget::insert($targets);
        }

        // Gửi mail nếu chọn loại mail
        if ($request->loai === 'mail' && !empty($request->users)) {
            $userEmails = NhanVien::whereIn('ma_nhan_vien', $request->users)->pluck('email')->toArray();
            foreach ($userEmails as $email) {
                Mail::to($email)->queue(new AdminNotificationMail($request->tieu_de, $request->noi_dung));
            }
        }
        // TODO: Gửi in-app notification nếu cần

        return redirect()->route('admin.notifications.create')->with('success', 'Đã gửi thông báo thành công!');
    }

    // Hiển thị danh sách thông báo cho user
    public function index(Request $request)
    {
        $user = Auth::guard('nhanvien')->user();
        if (!$user || !isset($user->ma_nhan_vien)) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem thông báo.');
        }
        $notifications = NotificationTarget::with('notification')
            ->where('ma_nhan_vien', $user->ma_nhan_vien)
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('pages.notifications', compact('notifications'));
    }

    // Xem chi tiết thông báo
    public function show($id)
    {
        $user = Auth::guard('nhanvien')->user();
        if (!$user || !isset($user->ma_nhan_vien)) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem thông báo.');
        }
        $target = NotificationTarget::with('notification')
            ->where('ma_nhan_vien', $user->ma_nhan_vien)
            ->where('id', $id)
            ->firstOrFail();
        return view('pages.notification_detail', compact('target'));
    }

    // Đánh dấu đã đọc
    public function markAsRead($id)
    {
        $user = Auth::guard('nhanvien')->user();
        if (!$user || !isset($user->ma_nhan_vien)) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem thông báo.');
        }
        $target = NotificationTarget::where('ma_nhan_vien', $user->ma_nhan_vien)
            ->where('id', $id)
            ->firstOrFail();
        $target->da_xem = true;
        $target->save();
        return redirect()->back()->with('success', 'Đã đánh dấu đã đọc!');
    }

    // Danh sách thông báo đã gửi cho admin
    public function adminIndex()
    {
        $notifications = Notification::withCount('targets')->orderByDesc('created_at')->paginate(10);
        return view('admin.notifications.list', compact('notifications'));
    }

    // Chi tiết 1 thông báo đã gửi
    public function adminShow($id)
    {
        $notification = Notification::findOrFail($id);
        $targets = NotificationTarget::with(['nhanVien' => function($q) {
            $q->with(['phongBan', 'viTri']);
        }])->where('notification_id', $id)->get();
        return view('admin.notifications.detail', compact('notification', 'targets'));
    }
}
