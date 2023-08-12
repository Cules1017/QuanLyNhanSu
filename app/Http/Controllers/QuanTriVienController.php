<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuanTriVienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=User::all();
        return view('pages.quantri',['data'=>$data]);
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
        $vitri_moi=new User();
        $vitri_moi->ten_dang_nhap=$request->ten_dang_nhap;
        $vitri_moi->password=$request->password;
        $vitri_moi->email=$request->email;
        $vitri_moi->created_at=Carbon::now();
        $vitri_moi->save();
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-quan-tri']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $a=User::find($id)->delete();
        if($a)
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-quan-tri']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $a=User::find($id);
        return view('pages.quantriedit',['data'=>$a]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $a=User::find($id);
        $a->ten_phong_ban=$request->ten_phong_ban;
        $a->updated_at=Carbon::now();
        $a->save();
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-quan-tri']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
