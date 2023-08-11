<?php

namespace App\Http\Controllers;

use App\Models\Luong;
use App\Models\NhanVien;
use App\Models\PhongBan;
use App\Models\ViTri;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nhanviens = NhanVien::paginate(5);
        $vitris = Vitri::all();
        $pbis=PhongBan::all();
        return view('pages.nhanvien',['nhanviens' => $nhanviens, 'vitris' => $vitris, 'pbis'=>$pbis]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $nhanviens = NhanVien::where('ho', 'like', '%'.$query.'%')
                            ->orWhere('ten', 'like', '%'.$query.'%')
                            ->orWhere('cccd', 'like', '%'.$query.'%')
                            ->orWhere('email', 'like', '%'.$query.'%')
                            ->paginate(5);
        $vitris = Vitri::all();
        $pbis=PhongBan::all();
        return view('pages.nhanvien', ['nhanviens' => $nhanviens, 'vitris' => $vitris, 'pbis'=>$pbis]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->file('anh_nhan_vien'));
        $path = $request->file('anh_nhan_vien')->store('public/profile');
        $path=substr($path, strlen('public/'));
        $vitri_moi=new NhanVien();
        $vitri_moi->ho=$request->ho;
        $vitri_moi->ten=$request->ten;
        $vitri_moi->cccd=$request->cccd;
        $vitri_moi->email=$request->email;
        $vitri_moi->anh_nhan_vien=$path;
        $vitri_moi->ma_vi_tri=$request->ma_vi_tri;
        $vitri_moi->ma_phong_ban=$request->ma_phong_ban;
        $vitri_moi->save();

        $luongNV = new Luong();
        $luongNV->ma_nhan_vien = $vitri_moi->ma_nhan_vien;
        $luongNV->tien_luong = $request->luong;
        $luongNV->ngay_cap_nhat = Carbon::now();
        $luongNV->save();

        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-nhan-vien']);
    }
    public function show(string $id)
    {
        $a=NhanVien::find($id)->delete();
        if($a)
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-nhan-vien']);
    }
    public function edit(string $id)
    {
        $a=NhanVien::find($id);
        $vitris = Vitri::all();
        $pbis=PhongBan::all();
        return view('pages.nhanvienedit',['data'=>$a,'vitris' => $vitris,'pbis'=>$pbis]); 
    }
    public function update(Request $request, string $id)
    {
        $vitri_moi=NhanVien::find($id);
        if($request->file('anh_nhan_vien')){
        $path = $request->file('anh_nhan_vien')->store('public/profile');
        $path=substr($path, strlen('public/'));$vitri_moi->anh_nhan_vien=$path;}
        
        $vitri_moi->ho=$request->ho;
        $vitri_moi->ten=$request->ten;
        $vitri_moi->cccd=$request->cccd;
        $vitri_moi->email=$request->email;
        
        $vitri_moi->ma_vi_tri=$request->ma_vi_tri;
        $vitri_moi->ma_phong_ban=$request->ma_phong_ban;
        $vitri_moi->save();
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-nhan-vien']);
    }
}