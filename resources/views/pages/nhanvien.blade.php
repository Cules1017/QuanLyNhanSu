@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản Lý Nhân Viên'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Bảng Quản Lý Nhân Viên</h6>
                    </div>

                    <div class="ms-md-auto pe-md-3 align-items-center">
                        <form action="{{ route('tim-kiem-nhan-vien') }}" method="GET">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" name="query" class="form-control" placeholder="Tìm kiếm...">
                            </div>
                        </form>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 20px !important;" >
                                            Mã nhân viên
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ảnh
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tên nhân viên
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            CCCD
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($nhanviens as $item)
                                    <tr>
                                        <td style="width: 20px !important; text-align:center;" class="align-middle">{{ $item->ma_nhan_vien }}</td>
                                        <td class="align-middle"><img style="height: 50px;max-width:100px;" src="{{asset('storage/'. $item->anh_nhan_vien)}}" alt=""></td>
                                        <td class="align-middle">{{ $item->ho }} {{ $item->ten }}</td>
                                        <td class="align-middle">{{ $item->cccd }}</td>
                                        <td class="align-middle">{{ $item->email }}</td>
                                        
                                        <td class="align-middle">
                                            <a style="color: blue !important" href="{{route('show-sua-nhan-vien',['id'=>$item->ma_nhan_vien])}}" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Sửa
                                            </a>
                                            <span style="min-width: 25px">|</span>
                                            <a style="color: brown !important" href="{{route('show-xoa-nhan-vien',['id'=>$item->ma_nhan_vien])}}" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Xóa
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $nhanviens->links() }} 
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Thêm Nhân Viên Mới</h6>
                    </div>
                    <div class="card-body">
                         <form action="{{ route('store-nhan-vien') }}" method="POST" enctype="multipart/form-data">{{--{{ route('nhan-vien.store') }} --}}
                            @csrf
                            <div class="mb-3">
                                <label for="ho" class="form-label">Họ Nhân Viên<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ho" name="ho" required="">
                            </div>
                            <div class="mb-3">
                                <label for="ten" class="form-label">Tên Nhân Viên<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ten" name="ten" required="">
                            </div>
                            <div class="mb-3">
                                <label for="cccd" class="form-label">CCCD <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cccd" name="cccd" required="">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="email" required="">
                            </div>
                            <div class="mb-3">
                                <label for="gioi_tinh" class="form-label">Giới tính <span class="text-danger">*</span></label>
                                <select class="form-control" id="gioi_tinh" name="gioi_tinh" required="">
                                    <option value="">Chọn giới tính</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ngay_sinh" class="form-label">Ngày sinh <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" required="">
                            </div>
                            <div class="mb-3">
                                <label for="luong" class="form-label">Lương <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="luong" name="luong" required="">
                            </div>
                            <div class="mb-3">
                                <label for="anh_nhan_vien" class="form-label">Ảnh nhan viên <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="anh_nhan_vien" name="anh_nhan_vien" required="">
                            </div>
                            <div class="mb-3">
                                <label for="ma_vi_tri" class="form-label">Vị trí<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="controls">
                                            <select name="ma_vi_tri" id="ma_vi_tri" required="" class="form-control">
                                                <option value="" selected="" disabled="">Chọn vị trí</option>
                                                @foreach ($vitris as $vitri)
                                                <option value="{{ $vitri->ma_vi_tri }}">{{$vitri->ten_vi_tri}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="mb-3">
                                <label for="ma_phong_ban" class="form-label">Phong Ban<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="controls">
                                            <select name="ma_phong_ban" id="ma_phong_ban" required="" class="form-control">
                                                <option value="" selected="" disabled="">Chọn phòng ban</option>
                                                @foreach ($pbis as $vitri)
                                                <option value="{{ $vitri->ma_phong_ban }}">{{$vitri->ten_phong_ban}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
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