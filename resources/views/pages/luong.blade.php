@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Bảng Quản Lý Lương</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Mã Lương</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Lương</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Mã Nhân Viên</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Tên Nhân Viên</th>
                                                
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Ngày Cập Nhật</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Thao tác</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($nhanviens as $item)
                                    <tr>
                                        <td class="align-middle">{{ $item->ma_luong }}</td>
                                        <td class="align-middle">{{ $item->tien_luong }}</td>
                                        <td class="align-middle">{{ $item->ma_nhan_vien }}</td>
                                        <td class="align-middle">{{ $item->ten_nhan_vien }}</td>
                                        <td class="align-middle">{{ $item->ngay_cap_nhat }}</td>
                                        
                                        <td class="align-middle">
                                            <a style="color: blue !important" href="{{route('show-sua-phong-ban',['id'=>$item->ma_phong_ban])}}" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Sửa
                                            </a>
                                       <span style="min-width: 25px">|</span>
                                            <a style="color: brown !important" href="{{route('show-xoa-phong-ban',['id'=>$item->ma_phong_ban])}}" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Xóa
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $luongs->links() }}
                    </div>
                </div>
            
        </div>
        <div class="row">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Thêm Lương Mới</h6>
                    </div>
                    <div class="card-body">
                         <form action="{{ route('store-luong') }}" method="POST">{{--{{ route('phong-ban.store') }} --}}
                            @csrf
                            <div class="mb-3">
                                <label for="luong" class="form-label">Lương</label>
                                <input type="text" class="form-control" id="luong" name="luong">
                            </div>
                            <div class="mb-3">
                                <label for="ma_nhan_vien" class="form-label">Nhân viên</label>
                                <input type="text" class="form-control" id="ma_nhan_vien" name="ma_nhan_vien">
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
        </div>
        

        @include('layouts.footers.auth.footer')
    </div>
@endsection
