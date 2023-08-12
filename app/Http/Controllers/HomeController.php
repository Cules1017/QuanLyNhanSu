<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Models\PhongBan;
use App\Models\User;
use App\Models\Vitri;
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

        $latestNV = NhanVien::latest()->first();
        if ($latestNV) {
            $nvlast = $latestNV->updated_at || $latestNV->created_at;
        }

        $latestPB = NhanVien::latest()->first();
        if ($latestPB) {
            $pblast = $latestPB->update_at || $latestPB->created_at;
        }

        $latestVT = NhanVien::latest()->first();
        if ($latestVT) {
            $vtlast = $latestVT->update_at || $latestVT->created_at;
        }

        $latestUser = NhanVien::latest()->first();
        if ($latestUser) {
            $userlast = $latestUser->update_at || $latestUser->created_at;
        }
        //dd(implode(',',$listcountnhanvien),$thang);
        return view('pages.dashboard',[
            'thang'=>implode(',',$thang), 'listcountnhanvien'=>implode(',',$listcountnhanvien) ,
            'countNV' => $countNV, 'countPB' => $countPB, 'countVT' => $countVT, 'countUser' => $countUser,
            'nvlast' => $nvlast, 'pblast' => $pblast, 'vtlast' => $vtlast, 'userlast' => $userlast, 
        ]);
    }
}
