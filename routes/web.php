<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\PhongBanController;
use App\Http\Controllers\QuanTriVienController;
use App\Http\Controllers\VitriController;

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	//Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth:nhanvien'], function () {
	//Route::group('/nhanvien-dc', function () {
		Route::get('/nhanvien-dc',[NhanVienController::class,'index1'])->name('xem-nhanvien-dc');
		Route::post('/nhanvien-dc',[NhanVienController::class,'store1'])->name('store-nhanvien-dc');
		Route::get('/xoa-nhanvien-dc',[NhanVienController::class,'show1'])->name('show-xoa-nhanvien-dc');
		Route::get('/sua-nhanvien-dc',[NhanVienController::class,'edit1'])->name('show-sua-nhanvien-dc');
		Route::post('/chinh-nhanvien-dc',[NhanVienController::class,'update1'])->name('chinh-sua-nhanvien-dc');
});
Route::group(['middleware' => 'auth:web'], function () {
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
	Route::get('/vi-tri',[VitriController::class,'index'])->name('xem-vi-tri');
	Route::post('/luu-vi-tri',[VitriController::class,'store'])->name('store-vi-tri');
	Route::get('/xoa-vi-tri/{id}',[VitriController::class,'show'])->name('show-xoa-vi-tri');
	Route::get('/sua-vi-tri/{id}',[VitriController::class,'edit'])->name('show-sua-vi-tri');
	Route::post('/chinh-vi-tri/{id}',[VitriController::class,'update'])->name('chinh-sua-vi-tri');
	
	Route::get('/phong-ban',[PhongBanController::class,'index'])->name('xem-phong-ban');
	Route::post('/luu-phong-ban',[PhongBanController::class,'store'])->name('store-phong-ban');
	Route::get('/xoa-phong-ban/{id}',[PhongBanController::class,'show'])->name('show-xoa-phong-ban');
	Route::get('/sua-phong-ban/{id}',[PhongBanController::class,'edit'])->name('show-sua-phong-ban');
	Route::post('/chinh-phong-ban/{id}',[PhongBanController::class,'update'])->name('chinh-sua-phong-ban');
	
	Route::get('/quan-tri',[QuanTriVienController::class,'index'])->name('xem-quan-tri');
	Route::post('/luu-quan-tri',[QuanTriVienController::class,'store'])->name('store-quan-tri');
	Route::get('/xoa-quan-tri/{id}',[QuanTriVienController::class,'show'])->name('show-xoa-quan-tri');
	Route::get('/sua-quan-tri/{id}',[QuanTriVienController::class,'edit'])->name('show-sua-quan-tri');
	Route::post('/chinh-quan-tri/{id}',[QuanTriVienController::class,'update'])->name('chinh-sua-quan-tri');

	Route::get('/nhan-vien',[NhanVienController::class,'index'])->name('xem-nhan-vien');
	Route::post('/luu-nhan-vien',[NhanVienController::class,'store'])->name('store-nhan-vien');
	Route::get('/xoa-nhan-vien/{id}',[NhanVienController::class,'show'])->name('show-xoa-nhan-vien');
	Route::get('/sua-nhan-vien/{id}',[NhanVienController::class,'edit'])->name('show-sua-nhan-vien');
	Route::post('/chinh-nhan-vien/{id}',[NhanVienController::class,'update'])->name('chinh-sua-nhan-vien');

	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');


	///
	
});