@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Gửi thông báo'])
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-10 col-md-12 col-12">
                <div class="card mb-4 shadow" style="max-width: 1000px; margin: auto;">
                    <div class="card-header pb-0">
                        <h6 class="mb-0">Gửi thông báo mới</h6>
                    </div>
                    <div class="card-body px-4 pt-3 pb-2">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('admin.notifications.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="tieu_de" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control" id="tieu_de" name="tieu_de" required>
                            </div>
                            <div class="mb-3">
                                <label for="noi_dung" class="form-label">Nội dung</label>
                                <textarea class="form-control" id="noi_dung" name="noi_dung" rows="4" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="loai" class="form-label">Loại gửi</label>
                                <select class="form-select" id="loai" name="loai" required>
                                    <option value="mail">Gửi Email</option>
                                    <option value="in-app">Thông báo trong hệ thống</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Chọn nhân viên (giữ Ctrl để chọn nhiều)</label>
                                <select class="form-select" name="users[]" multiple size="5">
                                    @foreach($users as $user)
                                        <option value="{{ $user->ma_nhan_vien }}">{{ $user->ho_ten }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Chọn phòng ban (giữ Ctrl để chọn nhiều)</label>
                                <select class="form-select" name="departments[]" multiple size="4">
                                    @foreach($departments as $dep)
                                        <option value="{{ $dep->ma_phong_ban }}">{{ $dep->ten_phong_ban }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Chọn vị trí (giữ Ctrl để chọn nhiều)</label>
                                <select class="form-select" name="positions[]" multiple size="4">
                                    @foreach($positions as $pos)
                                        <option value="{{ $pos->ma_vi_tri }}">{{ $pos->ten_vi_tri }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="nguoi_gui_id" value="{{ auth()->user()->id ?? 1 }}">
                            <button type="submit" class="btn btn-primary w-100">Gửi thông báo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection 