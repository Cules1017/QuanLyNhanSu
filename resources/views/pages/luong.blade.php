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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 20px !important;">
                                        Mã Lương</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Mã Nhân Viên</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Lương</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ngày Cập Nhật</th>
                                    
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($luongs as $item)
                                <tr>
                                    <td class="align-middle text-center" style="width: 20px !important;">{{ $item->ma_luong }}</td>
                                    <td class="align-middle text-center">{{ $item->ma_nhan_vien }}</td>
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
