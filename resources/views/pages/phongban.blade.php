@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Bảng Quản Lý Phòng Ban</h6>
                    </div>
                    
                    <div class="ms-md-auto pe-md-3 align-items-center">
                        <form action="{{ route('tim-kiem-phong-ban') }}" method="GET">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Mã Phòng Ban</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tên Phòng Ban</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Thao tác</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td class="align-middle">{{ $item->ma_phong_ban }}</td>
                                        <td class="align-middle">{{ $item->ten_phong_ban }}</td>
                                        
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
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Thêm Phòng Ban Mới</h6>
                    </div>
                    <div class="card-body">
                         <form action="{{ route('store-phong-ban') }}" method="POST">{{--{{ route('phong-ban.store') }} --}}
                            @csrf
                            <div class="mb-3">
                                <label for="ten_phong_ban" class="form-label">Tên phòng ban</label>
                                <input type="text" class="form-control" id="ten_phong_ban" name="ten_phong_ban">
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
