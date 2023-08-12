<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        //dd(bcrypt('nhanvien'));
        $credentials = $request->validate([
            'ten_dang_nhap' => ['required'],
            'password' => ['required'],
        ]);
        

        if (Auth::guard('web')->attempt(['ten_dang_nhap' => $request->ten_dang_nhap, 'password' => $request->password])) {
            $request->session()->regenerate();
            //dd($request->session());

            return redirect()->intended('trang-chu');
        }
        if (Auth::guard('nhanvien')->attempt(['ten' => $request->ten_dang_nhap, 'password' => $request->password])) {
           
            $request->session()->regenerate();
           //dd($request->session());
           //dd(Auth::guard('web'),Auth::guard('nhanvien'));

            return redirect()->intended('nhanvien-dc');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        if(Auth::guard('web')->user())Auth::guard('web')->logout();
        if(Auth::guard('nhanvien')->user())Auth::guard('nhanvien')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
