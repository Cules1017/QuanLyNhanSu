<?php

namespace App\Http\Controllers;

use App\Models\Luong;
use App\Models\NhanVien;
use App\Models\PhongBan;
use App\Models\Vitri;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function editLuong($id)
    {
        $nhanvien = NhanVien::find($id);
        $luongcu = Luong::where('ma_nhan_vien', $id)->latest('ngay_cap_nhat')->first();
        return view('pages.editluong',['data' => $nhanvien, 'luongcu' => $luongcu]);
    }

    public function updateLuong(Request $request, $id)
    {
        $luong = new Luong();
        $luong->ma_nhan_vien= $id;
        $luong->tien_luong = $request->luong_moi;
        $luong->ngay_cap_nhat = Carbon::now();
        $luong->save();
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-nhan-vien']);
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
        $vitri_moi->password=bcrypt('nhanvien');
        $vitri_moi->created_at=Carbon::now();

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
        $vitri_moi->updated_at=Carbon::now();
        $vitri_moi->save();
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-nhan-vien']);
    }


    public function index1()
    {
        //dd(Auth::guard('nhanvien')->user());
        $nhanviens = Auth::guard('nhanvien')->user();
        $vitris = Vitri::find($nhanviens->ma_vi_tri);
        $pbis=PhongBan::find($nhanviens->ma_phong_ban);
        $luong=Luong::where('ma_nhan_vien',$nhanviens->ma_nhan_vien)->first();
        //dd($luong);
        return view('pages.tttk',['data' => $nhanviens, 'vitris' => $vitris,'pbis'=>$pbis,'luong'=>$luong]);
    }

    public function viewSalaryHistory()
    {
        //dd(Auth::guard('nhanvien')->user());
        $nhanviens = Auth::guard('nhanvien')->user();
        $vitris = Vitri::find($nhanviens->ma_vi_tri);
        $pbis= PhongBan::find($nhanviens->ma_phong_ban);
        $luong= Luong::where('ma_nhan_vien',$nhanviens->ma_nhan_vien)->paginate(10);
        //dd($luong);
        return view('pages.lichsuluong',['data' => $nhanviens, 'vitris' => $vitris, 'pbis'=>$pbis, 'luongs'=>$luong]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create1()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store1(Request $request)
    {
        //dd($request->file('anh_nhan_vien'));
        $nhanviens = Auth::guard('nhanvien')->user();
        //dd($request->all(),['ten' => $nhanviens->ten, 'password' => $request->pass_old],Auth::guard('nhanvien')->attempt(['ten' => $nhanviens->ten, 'password' => $request->pass_old]));
        if (Auth::guard('nhanvien')->attempt(['ten' => $nhanviens->ten, 'password' => $request->pass_old])) {
            $a=NhanVien::find($nhanviens->ma_nhan_vien);
            $a->password=$request->pass_new;
            $a->save();
            $request->session()->regenerate();
            return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-nhanvien-dc']);
        }
        return view('pages.thatbai',['msg'=>"Thông tin nhập sai",'link'=>'xem-nhanvien-dc']);
        
    }
    public function show1(string $id)
    {
        $a=NhanVien::find($id)->delete();
        if($a)
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-nhan-vien']);
    }
    public function edit1(string $id)
    {
        $a=NhanVien::find($id);
        $vitris = Vitri::all();
        $pbis=PhongBan::all();
        return view('pages.nhanvienedit',['data'=>$a,'vitris' => $vitris,'pbis'=>$pbis]); 
    }
    public function update1(Request $request)
    {
        $vitri_moi=NhanVien::find(Auth::guard('nhanvien')->user()->ma_nhan_vien);
        if($request->file('anh_nhan_vien')){
        $path = $request->file('anh_nhan_vien')->store('public/profile');
        $path=substr($path, strlen('public/'));$vitri_moi->anh_nhan_vien=$path;}
        
        $vitri_moi->ho=$request->ho;
        $vitri_moi->ten=$request->ten;
        $vitri_moi->cccd=$request->cccd;
        
        $vitri_moi->save();
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-nhanvien-dc']);
    }
}