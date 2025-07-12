<?php

namespace App\Http\Controllers;

use App\Models\DiemDanh;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiemDanhController extends Controller
{
    public function index()
    {
        $nhanVien = Auth::guard('nhanvien')->user();
        $thang = request('thang', Carbon::now()->month);
        $nam = request('nam', Carbon::now()->year);

        $diemDanh = DiemDanh::where('ma_nhan_vien', $nhanVien->ma_nhan_vien)
            ->whereMonth('ngay', $thang)
            ->whereYear('ngay', $nam)
            ->get();

        $ngayHienTai = Carbon::now();
        $diemDanhHienTai = DiemDanh::where('ma_nhan_vien', $nhanVien->ma_nhan_vien)
            ->whereDate('ngay', $ngayHienTai)
            ->first();

        // Lấy thông tin phòng ban và vị trí
        $phongBan = $nhanVien->phongBan;
        $viTri = $nhanVien->viTri;
        $luong = $nhanVien->luong;

        // Kiểm tra và gán giá trị mặc định nếu null
        $pbis = $phongBan ?: (object)['ten_phong_ban' => 'Chưa phân phòng ban'];
        $vitris = $viTri ?: (object)['ten_vi_tri' => 'Chưa phân vị trí'];
        $luong = $luong ?: (object)['tien_luong' => 'Chưa cập nhật'];

        return view('pages.tttk', [
            'diemDanh' => $diemDanh,
            'diemDanhHienTai' => $diemDanhHienTai,
            'thang' => $thang,
            'nam' => $nam,
            'data' => $nhanVien,
            'pbis' => $pbis,
            'vitris' => $vitris,
            'luong' => $luong
        ]);
    }

    public function checkIn()
    {
        $nhanVien = Auth::guard('nhanvien')->user();
        $ngayHienTai = Carbon::now();

        $diemDanh = DiemDanh::where('ma_nhan_vien', $nhanVien->ma_nhan_vien)
            ->whereDate('ngay', $ngayHienTai)
            ->first();

        if (!$diemDanh) {
            $diemDanh = new DiemDanh();
            $diemDanh->ma_nhan_vien = $nhanVien->ma_nhan_vien;
            $diemDanh->ngay = $ngayHienTai;
        }

        $diemDanh->gio_vao = $ngayHienTai;
        $diemDanh->trang_thai = 'đã check in';
        $diemDanh->save();

        return redirect()->back()->with('success', 'Check in thành công!');
    }

    public function checkOut()
    {
        $nhanVien = Auth::guard('nhanvien')->user();
        $ngayHienTai = Carbon::now();

        $diemDanh = DiemDanh::where('ma_nhan_vien', $nhanVien->ma_nhan_vien)
            ->whereDate('ngay', $ngayHienTai)
            ->first();

        if (!$diemDanh || $diemDanh->trang_thai !== 'đã check in') {
            return redirect()->back()->with('error', 'Bạn chưa check in hôm nay!');
        }

        $diemDanh->gio_ra = $ngayHienTai;
        $diemDanh->trang_thai = 'đã check out';
        $diemDanh->save();

        return redirect()->back()->with('success', 'Check out thành công!');
    }
} 