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
use App\Http\Controllers\LuongController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\PhongBanController;
use App\Http\Controllers\QuanTriVienController;
use App\Http\Controllers\VitriController;
use App\Http\Controllers\DiemDanhController;

// Route::get('/', function () {return redirect('/dashboard');})->middleware('web');
Route::get('/', function () {return redirect('/trang-chu');})->middleware('webses');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->name('login');
	Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	//Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'nhanvien'], function () {
	Route::get('/nhanvien-dc', [DiemDanhController::class, 'index'])->name('xem-nhanvien-dc');
	Route::post('/nhanvien-dc', [NhanVienController::class, 'store1'])->name('store-nhanvien-dc');
	Route::get('/xoa-nhanvien-dc', [NhanVienController::class, 'show1'])->name('show-xoa-nhanvien-dc');
	Route::get('/sua-nhanvien-dc', [NhanVienController::class, 'edit1'])->name('show-sua-nhanvien-dc');
	Route::post('/chinh-nhanvien-dc', [NhanVienController::class, 'update1'])->name('chinh-sua-nhanvien-dc');
	Route::get('/lich-su-luong', [NhanVienController::class, 'viewSalaryHistory'])->name('lich-su-luong');
	Route::post('/check-in', [DiemDanhController::class, 'checkIn'])->name('check-in');
	Route::post('/check-out', [DiemDanhController::class, 'checkOut'])->name('check-out');
	// Route xem thông báo cho user
	Route::get('/thong-bao', [App\Http\Controllers\NotificationController::class, 'index'])->name('user.notifications.index');
	Route::get('/thong-bao/{id}', [App\Http\Controllers\NotificationController::class, 'show'])->name('user.notifications.show');
	Route::post('/thong-bao/{id}/da-xem', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('user.notifications.markAsRead');
});


Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('403ud', function(){return  view('pages.403',['data'=>'/dashboard']);})->name('403ad');
Route::get('403u', function(){return  view('pages.403',['data'=>'/nhanvien-dc']);})->name('403nv');


Route::group(['middleware' => 'webses'], function () {
	Route::get('/trang-chu', [HomeController::class, 'index'])->name('home');
	Route::get('/vi-tri',[VitriController::class,'index'])->name('xem-vi-tri');
	Route::post('/luu-vi-tri',[VitriController::class,'store'])->name('store-vi-tri');
	Route::get('/xoa-vi-tri/{id}',[VitriController::class,'show'])->name('show-xoa-vi-tri');
	Route::get('/sua-vi-tri/{id}',[VitriController::class,'edit'])->name('show-sua-vi-tri');
	Route::post('/chinh-vi-tri/{id}',[VitriController::class,'update'])->name('chinh-sua-vi-tri');
	Route::get('/tim-kiem-vi-tri',[VitriController::class,'search'])->name('tim-kiem-vi-tri');
	
	Route::get('/phong-ban',[PhongBanController::class,'index'])->name('xem-phong-ban');
	Route::post('/luu-phong-ban',[PhongBanController::class,'store'])->name('store-phong-ban');
	Route::get('/xoa-phong-ban/{id}',[PhongBanController::class,'show'])->name('show-xoa-phong-ban');
	Route::get('/sua-phong-ban/{id}',[PhongBanController::class,'edit'])->name('show-sua-phong-ban');
	Route::post('/chinh-phong-ban/{id}',[PhongBanController::class,'update'])->name('chinh-sua-phong-ban');
	Route::get('/tim-kiem-phong-ban',[PhongBanController::class,'search'])->name('tim-kiem-phong-ban');
	
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
	Route::get('/tim-kiem-nhan-vien',[NhanVienController::class,'search'])->name('tim-kiem-nhan-vien');
	Route::get('/chinh-sua-luong/{id}',[NhanVienController::class,'editLuong'])->name('chinh-sua-luong');
	Route::post('/cap-nhat-luong/{id}',[NhanVienController::class,'updateLuong'])->name('cap-nhat-luong');

	Route::get('/luong',[LuongController::class,'index'])->name('xem-luong');
	// Route::post('/luu-nhan-vien',[NhanVienController::class,'store'])->name('store-nhan-vien');
	// Route::get('/xoa-nhan-vien/{id}',[NhanVienController::class,'show'])->name('show-xoa-nhan-vien');
	// Route::get('/sua-nhan-vien/{id}',[NhanVienController::class,'edit'])->name('show-sua-nhan-vien');
	// Route::post('/chinh-nhan-vien/{id}',[NhanVienController::class,'update'])->name('chinh-sua-nhan-vien');
	// Route::get('/tim-kiem-nhan-vien',[NhanVienController::class,'search'])->name('tim-kiem-nhan-vien');

	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	///
	
	// Notification routes cho admin
	Route::get('/admin/notifications/create', [App\Http\Controllers\NotificationController::class, 'create'])->name('admin.notifications.create');
	Route::post('/admin/notifications', [App\Http\Controllers\NotificationController::class, 'store'])->name('admin.notifications.store');
	
});

// Route cho admin xem danh sách và chi tiết thông báo đã gửi
Route::middleware(['webses'])->group(function () {
    Route::get('/admin/notifications', [App\Http\Controllers\NotificationController::class, 'adminIndex'])->name('admin.notifications.list');
    Route::get('/admin/notifications/{id}', [App\Http\Controllers\NotificationController::class, 'adminShow'])->name('admin.notifications.detail');
});