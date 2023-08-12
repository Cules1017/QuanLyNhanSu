<?php

namespace App\Http\Controllers;

use App\Models\PhongBan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PhongBanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=PhongBan::paginate(5);
        return view('pages.phongban',['data'=>$data]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $data = PhongBan::where('ten_phong_ban', 'like', '%'.$query.'%')->paginate(5);
        return view('pages.phongban', ['data' => $data]);
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
        //dd($request->all());
        $vitri_moi=new PhongBan();
        $vitri_moi->ten_phong_ban=$request->ten_phong_ban;
        $vitri_moi->created_at=Carbon::now();
        $vitri_moi->save();
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-phong-ban']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $a=PhongBan::find($id)->delete();
        if($a)
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-phong-ban']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $a=PhongBan::find($id);
        return view('pages.phongbanedit',['data'=>$a]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $a=PhongBan::find($id);
        $a->ten_phong_ban=$request->ten_phong_ban;
        $a->updated_at=Carbon::now();
        $a->save();
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-phong-ban']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
