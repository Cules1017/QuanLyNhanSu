@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản Lý Nhân Viên'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Cập nhật lương nhân viên</h6>
                </div>
                <div class="card-body">
                     <form action="{{ route('cap-nhat-luong',['id'=>$data->ma_nhan_vien]) }}" method="POST" enctype="multipart/form-data">{{--{{ route('nhan-vien.store') }} --}}
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="tien_luong" class="form-label">Lương cũ<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tien_luong" name="tien_luong" required="" value="{{ $luongcu->tien_luong }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="luong_moi" class="form-label">Lương mới<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="luong_moi" name="luong_moi" required="" value="">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật lương</button>
                    </form>
                </div>
            </div>
        </div>
        

        @include('layouts.footers.auth.footer')
    </div>
@endsection
