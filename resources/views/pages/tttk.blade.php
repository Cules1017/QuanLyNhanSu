@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    {{-- @include('layouts.navbars.auth.topnav', ['title' => 'Profile']) --}}
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{asset('storage/'. $data->anh_nhan_vien)}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                           {{$data->ho.' '.$data->ten}}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{$pbis->ten_phong_ban.' - '.$vitris->ten_vi_tri}}
                        </p>
                        <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           >
                            Log out
                        </a>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            {{-- <li><a href="">LogOUT</a></li> --}}
                            {{-- <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "
                                    data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                                    <i class="ni ni-app"></i>
                                    <span class="ms-2">App</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                    data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                    <i class="ni ni-email-83"></i>
                                    <span class="ms-2">Messages</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                    data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span class="ms-2">Settings</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
                <div class="card">
                   
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Thông tin tài khoản</p>
                        <div class="row">
                            <form action="{{ route('chinh-sua-nhanvien-dc') }}" method="POST" enctype="multipart/form-data">{{--{{ route('nhan-vien.store') }} --}}
                                @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-control-label">Mã Nhân Viên</label>
                                    <input name="" class="form-control" type="text" value="{{$data->ma_nhan_vien}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cccd" class="form-control-label">CCCD</label>
                                    <input class="form-control" name="cccd" type="text" value="{{$data->cccd}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ten" class="form-control-label">Tên</label>
                                    <input class="form-control" name="ten" type="text" value="{{$data->ten}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ho" class="form-control-label">Họ</label>
                                    <input class="form-control" name="ho" type="text" value="{{$data->ho}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                            
                                <label for="anh_nhan_vien" class="form-label">UpLoad Ảnh Mới: </label>
                                <input type="file" class="form-control" id="anh_nhan_vien" name="anh_nhan_vien" ><img style="height: 50px;max-width:100px;" src="{{asset('storage/'. $data->anh_nhan_vien)}}" alt="">
                            </div>
                        </div> <div class="card-header pb-0">
                        <div class="align-items-center">
                            <p class="mb-0">Ấn để Lưu Thông Tin Đã Sửa:</p>
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Lưu</button>
                        </div>
                    </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Thông Tin Công Việc</p>
                        <div class="row">
                            {{-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Phòng Ban</label>
                                    <input class="form-control" type="text"
                                        value="{{$pbis->ten_phong_ban}}" readonly>
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Phòng Ban</label>
                                    <input class="form-control" type="text" value="{{$pbis->ten_phong_ban}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Vị Trí</label>
                                    <input class="form-control" type="text" value="{{$vitris->ten_vi_tri}}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Lương</label>
                                    <input class="form-control" type="text" value="{{$luong->tien_luong}}" readonly>
                                </div>
                            </div>
                        </form> 
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Đổi Mật Khẩu</p>
                        <form action="{{ route('store-nhanvien-dc') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pass_old" class="form-control-label">Mật Khẫu Cũ</label>
                                    <input class="form-control" type="text" name="pass_old"
                                         required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pass_new" class="form-control-label">Mật Khẩu Mới</label>
                                    <input class="form-control" type="text" name="pass_new"
                                         required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Lưu</button>
                        </div>
                        </form>
                    </div>
                </div>
         
            
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
