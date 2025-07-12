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
        $credentials = $request->validate([
            'ten_dang_nhap' => ['required'],
            'password' => ['required'],
        ]);
        
        // Thử đăng nhập với tài khoản admin
        if (Auth::guard('web')->attempt(['ten_dang_nhap' => $request->ten_dang_nhap, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('trang-chu');
        }

        // Thử đăng nhập với tài khoản nhân viên bằng email
        if (Auth::guard('nhanvien')->attempt(['email' => $request->ten_dang_nhap, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('nhanvien-dc');
        }

        // Thử đăng nhập với tài khoản nhân viên bằng CCCD
        if (Auth::guard('nhanvien')->attempt(['cccd' => $request->ten_dang_nhap, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('nhanvien-dc');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
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
