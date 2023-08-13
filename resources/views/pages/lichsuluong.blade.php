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
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Bảng lịch sử lương</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mã Lương</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Lương</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ngày Cập Nhật</th>
                                    
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($luongs as $item)
                                <tr>
                                    <td class="align-middle">{{ $item->ma_luong }}</td>
                                    <td class="align-middle">{{ $item->tien_luong }}</td>
                                    <td class="align-middle">{{ $item->ngay_cap_nhat }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $luongs->links() }}
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
