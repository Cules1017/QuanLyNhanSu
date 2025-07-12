@extends('layouts.app')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        {{-- <div class="row">
            <div class="col-12">
                @include('layouts.navbars.guest.navbar')
            </div>
        </div> --}}
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Đăng Nhập</h4>
                                    <p class="mb-0">Nhập vào tài khoản và mật khẩu để đăng nhập</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login.perform') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <input type="text" name="ten_dang_nhap" class="form-control form-control-lg" placeholder="Email/CCCD/Tên đăng nhập" value="{{ old('ten_dang_nhap') }}">
                                            @error('ten_dang_nhap') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="flex flex-col mb-3">
                                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu" aria-label="Password">
                                            @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="remember" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">ghi nhớ tài khoản</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" 
                                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                                                           border: none; 
                                                           color: white; 
                                                           font-weight: 600;
                                                           transition: all 0.3s ease;
                                                           box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                                                Đăng Nhập
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative  h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://img.freepik.com/free-vector/modern-technology-blue-color_132230-201.jpg?w=1060');
              background-size: cover;
              background-position: center;
              background-repeat: no-repeat;
              width: 100%;
              height: 100%;">
                                <span class=" opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Hệ Thống Quản Trị Nhân Viên "</h4>
                                <p class="text-white position-relative"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
