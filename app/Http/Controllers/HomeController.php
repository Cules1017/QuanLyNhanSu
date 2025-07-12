<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Models\PhongBan;
use App\Models\User;
use App\Models\Vitri;
use App\Models\Luong;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $countNV = NhanVien::count();
        $countPB =PhongBan::count();
        $countVT =Vitri::count();
        $countUser =User::count();
        //Todo: trả về biến $data là các thông tin thống kê nhân viên được tạo theo từ tháng
        $data = NhanVien::selectRaw('MONTH(created_at) as thang, COUNT(*) as count')
        ->groupBy('thang')
        ->orderBy('thang')
        ->get();

        $thang = [];
        $listcountnhanvien = [];

        foreach ($data as $item) {
            $thang[] = Carbon::create()->month($item->thang)->format('F'); // Tạo chuỗi tháng bằng cách định dạng từ số tháng
            $listcountnhanvien[] = $item->count;
        }

        $latestNV = NhanVien::latest('updated_at')->first();
        if ($latestNV) {
            $nvlast = $latestNV->updated_at;
        }

        $latestPB = PhongBan::latest('updated_at')->first();
        if ($latestPB) {
            $pblast = $latestPB->updated_at;
        }

        $latestVT = Vitri::latest('updated_at')->first();
        if ($latestVT) {
            $vtlast = $latestVT->updated_at;
        }

        $latestUser = User::latest('updated_at')->first();
        if ($latestUser) {
            $userlast = $latestUser->updated_at;
        }

        // Thống kê lương tổng và trung bình
        $tongLuong = Luong::sum('tien_luong');
        $luongTrungBinh = Luong::avg('tien_luong');
        // Thống kê lương theo phòng ban
        $luongTheoPhongBan = PhongBan::select('phong_ban.ma_phong_ban', 'phong_ban.ten_phong_ban')
            ->leftJoin('nhan_vien', 'phong_ban.ma_phong_ban', '=', 'nhan_vien.ma_phong_ban')
            ->leftJoin('luong', 'nhan_vien.ma_nhan_vien', '=', 'luong.ma_nhan_vien')
            ->selectRaw('phong_ban.ten_phong_ban, SUM(luong.tien_luong) as tong_luong, AVG(luong.tien_luong) as tb_luong, COUNT(nhan_vien.ma_nhan_vien) as so_nv')
            ->groupBy('phong_ban.ma_phong_ban', 'phong_ban.ten_phong_ban')
            ->get();

        // Thống kê nhân viên từng phòng ban
        $nhanVienPhongBan = PhongBan::select('phong_ban.ma_phong_ban', 'phong_ban.ten_phong_ban')
            ->leftJoin('nhan_vien', 'phong_ban.ma_phong_ban', '=', 'nhan_vien.ma_phong_ban')
            ->selectRaw('phong_ban.ten_phong_ban, COUNT(nhan_vien.ma_nhan_vien) as so_nv')
            ->groupBy('phong_ban.ma_phong_ban', 'phong_ban.ten_phong_ban')
            ->get();

        // Thống kê theo giới tính theo từng phòng ban
        $nhanVienGioiTinhPhongBan = NhanVien::selectRaw('ma_phong_ban, gioi_tinh, COUNT(*) as so_nv')
            ->groupBy('ma_phong_ban', 'gioi_tinh')
            ->get();

        // Chuyển đổi dữ liệu cho biểu đồ
        $phongBanLabels = [];
        $namData = [];
        $nuData = [];
        $khacData = [];

        foreach ($nhanVienGioiTinhPhongBan as $item) {
            if (!in_array($item->ma_phong_ban, $phongBanLabels)) {
                $phongBanLabels[] = $item->ma_phong_ban;
                $namData[$item->ma_phong_ban] = 0;
                $nuData[$item->ma_phong_ban] = 0;
                $khacData[$item->ma_phong_ban] = 0;
            }
            
            if ($item->gioi_tinh == 'Nam') {
                $namData[$item->ma_phong_ban] = $item->so_nv;
            } elseif ($item->gioi_tinh == 'Nữ') {
                $nuData[$item->ma_phong_ban] = $item->so_nv;
            } else {
                $khacData[$item->ma_phong_ban] = $item->so_nv;
            }
        }

        // Lấy tên phòng ban
        $phongBanNames = PhongBan::whereIn('ma_phong_ban', $phongBanLabels)
            ->pluck('ten_phong_ban', 'ma_phong_ban')
            ->toArray();

        // Thống kê nhân viên theo giới tính
        $nhanVienGioiTinh = NhanVien::selectRaw('gioi_tinh, COUNT(*) as so_nv')
            ->groupBy('gioi_tinh')
            ->get();

        // Thống kê nhân viên theo tuổi
        $nhanVienTuoi = NhanVien::selectRaw('YEAR(CURRENT_DATE) - YEAR(ngay_sinh) as tuoi, COUNT(*) as so_nv')
            ->groupBy('tuoi')
            ->orderBy('tuoi')
            ->get();

        // Thống kê lương theo tháng (toàn bộ nhân viên)
        $luongTheoThang = \App\Models\Luong::selectRaw('MONTH(ngay_cap_nhat) as thang, SUM(tien_luong) as tong_luong')
            ->groupBy('thang')
            ->orderBy('thang')
            ->get();
        $thangLuong = [];
        $tongLuongTheoThang = [];
        foreach ($luongTheoThang as $item) {
            $thangLuong[] = Carbon::create()->month($item->thang)->format('F');
            $tongLuongTheoThang[] = $item->tong_luong;
        }

        // Thống kê lương theo tháng cho từng phòng ban
        $luongTheoThangPhongBan = \App\Models\PhongBan::select('phong_ban.ma_phong_ban', 'phong_ban.ten_phong_ban')
            ->leftJoin('nhan_vien', 'phong_ban.ma_phong_ban', '=', 'nhan_vien.ma_phong_ban')
            ->leftJoin('luong', 'nhan_vien.ma_nhan_vien', '=', 'luong.ma_nhan_vien')
            ->selectRaw('phong_ban.ten_phong_ban, MONTH(luong.ngay_cap_nhat) as thang, SUM(luong.tien_luong) as tong_luong')
            ->groupBy('phong_ban.ma_phong_ban', 'phong_ban.ten_phong_ban', 'thang')
            ->orderBy('thang')
            ->get();
        $luongTheoThangPhongBanData = [];
        foreach ($luongTheoThangPhongBan as $item) {
            if (!isset($luongTheoThangPhongBanData[$item->ten_phong_ban])) {
                $luongTheoThangPhongBanData[$item->ten_phong_ban] = [];
            }
            $luongTheoThangPhongBanData[$item->ten_phong_ban][] = [
                'thang' => Carbon::create()->month($item->thang)->format('F'),
                'tong_luong' => $item->tong_luong
            ];
        }

        //dd(implode(',',$listcountnhanvien),$thang);
        return view('pages.dashboard',[
            'thang'=>implode(',',$thang), 'listcountnhanvien'=>implode(',',$listcountnhanvien) ,
            'countNV' => $countNV, 'countPB' => $countPB, 'countVT' => $countVT, 'countUser' => $countUser,
            'nvlast' => $nvlast, 'pblast' => $pblast, 'vtlast' => $vtlast, 'userlast' => $userlast, 
            // Thêm các biến thống kê lương
            'tongLuong' => $tongLuong,
            'luongTrungBinh' => $luongTrungBinh,
            'luongTheoPhongBan' => $luongTheoPhongBan,
            // Thêm biến thống kê lương theo tháng
            'thangLuong' => implode(',', $thangLuong),
            'tongLuongTheoThang' => implode(',', $tongLuongTheoThang),
            'luongTheoThangPhongBanData' => $luongTheoThangPhongBanData,
            // Thêm biến thống kê nhân viên từng phòng ban
            'nhanVienPhongBan' => $nhanVienPhongBan,
            // Thêm biến thống kê nhân viên theo giới tính và tuổi
            'nhanVienGioiTinh' => $nhanVienGioiTinh,
            'nhanVienTuoi' => $nhanVienTuoi,
            'nhanVienGioiTinhPhongBan' => [
                'labels' => array_values($phongBanNames),
                'nam' => array_values($namData),
                'nu' => array_values($nuData),
                'khac' => array_values($khacData)
            ],
        ]);
    }
}
