<?php

namespace App\Http\Controllers;

use App\Models\DonXinPhep;
use App\Models\NhanVien;
use App\Models\Notification;
use App\Models\NotificationTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DonXinPhepController extends Controller
{
    // Danh sách đơn xin phép
    public function index(Request $request)
    {
        $query = DonXinPhep::with('nhanVien');
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }
        if ($request->filled('loai_nghi')) {
            $query->where('loai_nghi', $request->loai_nghi);
        }
        $donXinPheps = $query->orderByDesc('created_at')->paginate(10);
        return view('admin.don_xin_phep.index', compact('donXinPheps'));
    }

    // Xem chi tiết đơn xin phép
    public function show($id)
    {
        $don = DonXinPhep::with('nhanVien')->findOrFail($id);
        // Tính số ngày nghỉ phép có lương đã duyệt trong năm hiện tại
        $nam = Carbon::parse($don->ngay_bat_dau)->year;
        $soNgayDaNghi = DonXinPhep::where('ma_nhan_vien', $don->ma_nhan_vien)
            ->where('loai_nghi', 'co_luong')
            ->where('trang_thai', 'da_duyet')
            ->whereYear('ngay_bat_dau', $nam)
            ->sum(DB::raw('DATEDIFF(ngay_ket_thuc, ngay_bat_dau) + 1'));
        return view('admin.don_xin_phep.show', compact('don', 'soNgayDaNghi'));
    }

    // Duyệt đơn xin phép
    public function approve($id)
    {
        $don = DonXinPhep::with('nhanVien')->findOrFail($id);
        if ($don->trang_thai !== 'cho_duyet') {
            return back()->with('error', 'Đơn đã được xử lý.');
        }
        // Kiểm tra số ngày nghỉ phép có lương còn lại
        if ($don->loai_nghi === 'co_luong') {
            $nam = Carbon::parse($don->ngay_bat_dau)->year;
            $soNgayDaNghi = DonXinPhep::where('ma_nhan_vien', $don->ma_nhan_vien)
                ->where('loai_nghi', 'co_luong')
                ->where('trang_thai', 'da_duyet')
                ->whereYear('ngay_bat_dau', $nam)
                ->sum(DB::raw('DATEDIFF(ngay_ket_thuc, ngay_bat_dau) + 1'));
            $soNgayDon = Carbon::parse($don->ngay_ket_thuc)->diffInDays(Carbon::parse($don->ngay_bat_dau)) + 1;
            if ($soNgayDaNghi + $soNgayDon > 12) {
                return back()->with('error', 'Nhân viên đã vượt quá số ngày nghỉ phép có lương trong năm.');
            }
        }
        $don->trang_thai = 'da_duyet';
        $don->save();
        // Gửi thông báo cho nhân viên
        $this->sendNotification($don, true);
        return back()->with('success', 'Đã duyệt đơn xin phép.');
    }

    // Từ chối đơn xin phép
    public function reject(Request $request, $id)
    {
        $request->validate([
            'ly_do_tu_choi' => 'required|string',
        ]);
        $don = DonXinPhep::with('nhanVien')->findOrFail($id);
        if ($don->trang_thai !== 'cho_duyet') {
            return back()->with('error', 'Đơn đã được xử lý.');
        }
        $don->trang_thai = 'tu_choi';
        $don->ly_do_tu_choi = $request->ly_do_tu_choi;
        $don->save();
        // Gửi thông báo cho nhân viên
        $this->sendNotification($don, false, $request->ly_do_tu_choi);
        return back()->with('success', 'Đã từ chối đơn xin phép.');
    }

    // Hiển thị form và danh sách đơn xin phép của nhân viên
    public function userIndex(Request $request)
    {
        $user = auth()->guard('nhanvien')->user();
        $query = DonXinPhep::where('ma_nhan_vien', $user->ma_nhan_vien);
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }
        if ($request->filled('loai_nghi')) {
            $query->where('loai_nghi', $request->loai_nghi);
        }
        $donXinPheps = $query->orderByDesc('created_at')->paginate(10);
        // Tính số ngày phép có lương đã dùng trong năm
        $nam = now()->year;
        $soNgayDaNghi = DonXinPhep::where('ma_nhan_vien', $user->ma_nhan_vien)
            ->where('loai_nghi', 'co_luong')
            ->where('trang_thai', 'da_duyet')
            ->whereYear('ngay_bat_dau', $nam)
            ->sum(\DB::raw('DATEDIFF(ngay_ket_thuc, ngay_bat_dau) + 1'));
        return view('pages.don_xin_phep_user', compact('donXinPheps', 'soNgayDaNghi'));
    }

    // Xử lý gửi đơn xin phép của nhân viên
    public function userStore(Request $request)
    {
        $user = auth()->guard('nhanvien')->user();
        $request->validate([
            'loai_nghi' => 'required|in:co_luong,khong_luong',
            'ngay_bat_dau' => 'required|date|after_or_equal:today',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
            'ly_do' => 'required|string|max:1000',
        ], [
            'ngay_bat_dau.after_or_equal' => 'Không được chọn ngày trong quá khứ.',
            'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.'
        ]);
        $soNgayDon = \Carbon\Carbon::parse($request->ngay_ket_thuc)->diffInDays(\Carbon\Carbon::parse($request->ngay_bat_dau)) + 1;
        if ($request->loai_nghi === 'co_luong') {
            $nam = \Carbon\Carbon::parse($request->ngay_bat_dau)->year;
            $soNgayDaNghi = DonXinPhep::where('ma_nhan_vien', $user->ma_nhan_vien)
                ->where('loai_nghi', 'co_luong')
                ->where('trang_thai', 'da_duyet')
                ->whereYear('ngay_bat_dau', $nam)
                ->sum(\DB::raw('DATEDIFF(ngay_ket_thuc, ngay_bat_dau) + 1'));
            $soNgayConLai = 12 - $soNgayDaNghi;
            if ($soNgayDon > $soNgayConLai) {
                return back()->withInput()->with('error', 'Bạn không đủ ngày phép có lương còn lại.');
            }
        }
        DonXinPhep::create([
            'ma_nhan_vien' => $user->ma_nhan_vien,
            'loai_nghi' => $request->loai_nghi,
            'ngay_bat_dau' => $request->ngay_bat_dau,
            'ngay_ket_thuc' => $request->ngay_ket_thuc,
            'ly_do' => $request->ly_do,
            'trang_thai' => 'cho_duyet',
        ]);
        return redirect()->route('user.don_xin_phep.index')->with('success', 'Gửi đơn xin phép thành công!');
    }

    // Gửi thông báo cho nhân viên
    protected function sendNotification($don, $approved, $lyDoTuChoi = null)
    {
        $tieuDe = $approved ? 'Đơn xin phép đã được duyệt' : 'Đơn xin phép bị từ chối';
        $noiDung = $approved
            ? "Đơn xin nghỉ phép từ {$don->ngay_bat_dau} đến {$don->ngay_ket_thuc} đã được duyệt." 
            : "Đơn xin nghỉ phép từ {$don->ngay_bat_dau} đến {$don->ngay_ket_thuc} đã bị từ chối. Lý do: $lyDoTuChoi";
        $notification = Notification::create([
            'tieu_de' => $tieuDe,
            'noi_dung' => $noiDung,
            'loai' => 'in-app',
            'nguoi_gui_id' => auth()->user()->id ?? 1, // fallback admin id
        ]);
        NotificationTarget::create([
            'notification_id' => $notification->id,
            'ma_nhan_vien' => $don->ma_nhan_vien,
            'da_xem' => false,
        ]);
    }
} 