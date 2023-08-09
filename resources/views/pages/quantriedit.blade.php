@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Chỉnh Sửa Phòng Ban</h6>
                    </div>
                    <div class="card-body">
                         <form action="{{ route('chinh-sua-phong-ban',['id'=>$data->ma_phong_ban]) }}" method="POST">{{--{{ route('phong-ban.store') }} --}}
                            @csrf
                            {{-- @dd($data)  --}}
                            <div class="mb-3">
                                <label for="ten_dang_nhap" class="form-label">Tên Quản Trị Viên</label>
                                <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Quản Trị Viên</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
        </div>
        

        @include('layouts.footers.auth.footer')
    </div>
@endsection
