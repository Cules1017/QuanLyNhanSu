<?php

namespace App\Http\Controllers;

use App\Models\Vitri;
use Illuminate\Http\Request;

class VitriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Vitri::all();
        return view('pages.vitri',['data'=>$data]);
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
        
        $vitri_moi=new Vitri();
        $vitri_moi->ten_vi_tri=$request->ten_vi_tri;
        $vitri_moi->save();
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-vi-tri']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $a=Vitri::find($id)->delete();
        if($a)
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-vi-tri']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $a=Vitri::find($id);
        return view('pages.vitriedit',['data'=>$a]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $a=Vitri::find($id);
        $a->ten_vi_tri=$request->ten_vi_tri;
        $a->save();
        return view('pages.thanhcong',['msg'=>"Thao Tác Thành Công",'link'=>'xem-vi-tri']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
