@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản Lý Nhân Viên'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Cập nhật nhân viên</h6>
                </div>
                <div class="card-body">
                     <form action="{{ route('chinh-sua-nhan-vien',['id'=>$data->ma_nhan_vien]) }}" method="POST" enctype="multipart/form-data">{{--{{ route('nhan-vien.store') }} --}}
                        @csrf
                        <div class="mb-3">
                            <label for="ho" class="form-label">Họ Nhân Viên<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ho" name="ho" required="" value="{{$data->ten}}">
                        </div>
                        <div class="mb-3">
                            <label for="ten" class="form-label">Tên Nhân Viên<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ten" name="ten" required="" value="{{$data->ho}}">
                        </div>
                        <div class="mb-3">
                            <label for="cccd" class="form-label">CCCD <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cccd" name="cccd" required="" value="{{$data->cccd}}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email" name="email" required="" value="{{$data->email}}">
                        </div>
                        <div class="mb-3">
                            <label for="anh_nhan_vien" class="form-label">Ảnh nhân viên </label>
                            <input type="file" class="form-control" id="anh_nhan_vien" name="anh_nhan_vien" ><img style="height: 50px;max-width:100px;" src="{{asset('storage/'. $data->anh_nhan_vien)}}" alt="">
                        </div>
                        <div class="mb-3">
                            <label for="ma_vi_tri" class="form-label">Vị trí<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <div class="controls">
                                        <select name="ma_vi_tri" id="ma_vi_tri" required="" class="form-control">
                                            <option value="" selected="" disabled="">Chọn vị trí</option>
                                            @foreach ($vitris as $vitri)
                                            <option {{$data->ma_vi_tri==$vitri->ma_vi_tri?'selected':''}} value="{{ $vitri->ma_vi_tri }}">{{$vitri->ten_vi_tri}}</option>
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
                                            <option {{$data->ma_phong_ban==$vitri->ma_phong_ban?'selected':''}} value="{{ $vitri->ma_phong_ban }}">{{$vitri->ten_phong_ban}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <a href="{{ route('chinh-sua-luong', ['id'=>$data->ma_nhan_vien]) }}"  class="btn btn-primary">Cập nhật lương</a>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
        

        @include('layouts.footers.auth.footer')
    </div>
@endsection
