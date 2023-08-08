@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Bảng Quản Lý Vị Trí</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Mã vị trí</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tên vị trí</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Thao tác</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td class="align-middle">{{ $item->ma_vi_tri }}</td>
                                        <td class="align-middle">{{ $item->ten_vi_tri }}</td>
                                        
                                        <td class="align-middle">
                                            <a style="color: blue !important" href="{{route('show-sua-vi-tri',['id'=>$item->ma_vi_tri])}}" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Sửa
                                            </a>
                                       <span style="min-width: 25px">|</span>
                                            <a style="color: brown !important" href="{{route('show-xoa-vi-tri',['id'=>$item->ma_vi_tri])}}" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Xóa
                                            </a>
                                        </td>
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
                        <h6>Thêm Vị Trí Mới</h6>
                    </div>
                    <div class="card-body">
                         <form action="{{ route('store-vi-tri') }}" method="POST">{{--{{ route('vi-tri.store') }} --}}
                            @csrf
                            <div class="mb-3">
                                <label for="ten_vi_tri" class="form-label">Tên vị trí</label>
                                <input type="text" class="form-control" id="ten_vi_tri" name="ten_vi_tri">
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
