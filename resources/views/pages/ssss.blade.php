@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Thông Tin Tài Khoản'])
    <div class="container-fluid py-4">
        <div class="row">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Thông tin Của Bạn</h6>
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
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
          
            
        </div>
        

        @include('layouts.footers.auth.footer')
    </div>
@endsection