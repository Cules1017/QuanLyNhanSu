@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Bảng Quản Lý Quản Trị Viên</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Mã Quản Trị Viên</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tên Quản Trị Viên</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Email</th>
                                            {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Thao tác</th> --}}
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td class="align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->ten_dang_nhap }}</td>
                                        <td class="align-middle">{{ $item->email }}</td>
                                        
                                        {{-- <td class="align-middle">
                                            <a style="color: blue !important" href="{{route('show-sua-quan-tri',['id'=>$item->id])}}" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Sửa
                                            </a>
                                       <span style="min-width: 25px">|</span>
                                            <a style="color: brown !important" href="{{route('show-xoa-quan-tri',['id'=>$item->id])}}" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Xóa
                                            </a>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Thêm Quản Trị Viên Mới</h6>
                    </div>
                    <div class="card-body">
                         <form action="{{ route('store-quan-tri') }}" method="POST">{{--{{ route('quan-tri.store') }} --}}
                            @csrf
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
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        

        @include('layouts.footers.auth.footer')
    </div>
@endsection
