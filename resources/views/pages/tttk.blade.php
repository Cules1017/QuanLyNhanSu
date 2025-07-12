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
                        </form>
                    </div>
                </div>
                @php
    $user = \Auth::guard('nhanvien')->user();
    $unreadCount = 0;
    $unreadNotifications = [];
    if ($user && isset($user->ma_nhan_vien)) {
        $unreadNotifications = \App\Models\NotificationTarget::with('notification')
            ->where('ma_nhan_vien', $user->ma_nhan_vien)
            ->where('da_xem', false)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();
        $unreadCount = \App\Models\NotificationTarget::where('ma_nhan_vien', $user->ma_nhan_vien)
            ->where('da_xem', false)
            ->count();
    }
@endphp
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0 d-flex justify-content-end align-items-center">
                        <div class="dropdown">
                            <a href="#" class="position-relative" id="profileNotificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell fa-2x text-primary cursor-pointer"></i>
                                @if($unreadCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:10px;">{{ $unreadCount }}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="profileNotificationDropdown" style="min-width: 320px;">
                                <li class="mb-2"><strong>Thông báo chưa đọc</strong></li>
                                @forelse($unreadNotifications as $item)
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="{{ route('user.notifications.show', $item->id) }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">{{ $item->notification->tieu_de ?? 'Thông báo' }}</span>
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        {{ $item->created_at->format('d/m/Y H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li><span class="dropdown-item text-muted">Không có thông báo mới.</span></li>
                                @endforelse
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center" href="{{ route('user.notifications.index') }}">Xem tất cả thông báo</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Điểm danh</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row p-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Điểm danh hôm nay</h5>
                                        <p class="card-text">
                                            @if($diemDanhHienTai)
                                                <strong>Trạng thái:</strong> {{ $diemDanhHienTai->trang_thai }}<br>
                                                @if($diemDanhHienTai->gio_vao)
                                                    <strong>Giờ vào:</strong> {{ $diemDanhHienTai->gio_vao }}<br>
                                                @endif
                                                @if($diemDanhHienTai->gio_ra)
                                                    <strong>Giờ ra:</strong> {{ $diemDanhHienTai->gio_ra }}
                                                @endif
                                            @else
                                                Chưa điểm danh hôm nay
                                            @endif
                                        </p>
                                        @if(!$diemDanhHienTai || $diemDanhHienTai->trang_thai === 'chưa điểm danh')
                                            <form action="{{ route('check-in') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Check In</button>
                                            </form>
                                        @elseif($diemDanhHienTai->trang_thai === 'đã check in')
                                            <form action="{{ route('check-out') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-warning">Check Out</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row p-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Lịch sử điểm danh</h5>
                                        <form action="{{ route('xem-nhanvien-dc') }}" method="GET" class="row g-3">
                                            <div class="col-auto">
                                                <select name="thang" class="form-select">
                                                    @for($i = 1; $i <= 12; $i++)
                                                        <option value="{{ $i }}" {{ $thang == $i ? 'selected' : '' }}>
                                                            Tháng {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-auto">
                                                <select name="nam" class="form-select">
                                                    @for($i = 2024; $i <= 2025; $i++)
                                                        <option value="{{ $i }}" {{ $nam == $i ? 'selected' : '' }}>
                                                            Năm {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary">Xem</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày</th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Giờ vào</th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Giờ ra</th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Trạng thái</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($diemDanh as $dd)
                                                        <tr>
                                                            <td>{{ \Carbon\Carbon::parse($dd->ngay)->format('d/m/Y') }}</td>
                                                            <td>{{ $dd->gio_vao ? \Carbon\Carbon::parse($dd->gio_vao)->format('H:i:s') : '-' }}</td>
                                                            <td>{{ $dd->gio_ra ? \Carbon\Carbon::parse($dd->gio_ra)->format('H:i:s') : '-' }}</td>
                                                            <td>{{ $dd->trang_thai }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <p class="text-uppercase text-sm">Thông tin tài khoản</p>
                    <div class="row">
                        <form action="{{ route('chinh-sua-nhanvien-dc') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-control-label">Mã Nhân Viên</label>
                                    <input name="" class="form-control" type="text" value="{{$data->ma_nhan_vien}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cccd" class="form-control-label">CCCD</label>
                                    <input class="form-control" name="cccd" type="text" value="{{$data->cccd}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ten" class="form-control-label">Tên</label>
                                    <input class="form-control" name="ten" type="text" value="{{$data->ten}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ho" class="form-control-label">Họ</label>
                                    <input class="form-control" name="ho" type="text" value="{{$data->ho}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input class="form-control" name="email" type="email" value="{{$data->email}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="anh_nhan_vien" class="form-label">UpLoad Ảnh Mới: </label>
                                <input type="file" class="form-control" id="anh_nhan_vien" name="anh_nhan_vien" ><img style="height: 50px;max-width:100px;" src="{{asset('storage/'. $data->anh_nhan_vien)}}" alt="">
                            </div>
                        </div> 
                        <div class="card-header pb-0">
                            <div class="align-items-center">
                                <p class="mb-0">Ấn để Lưu Thông Tin Đã Sửa:</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Lưu</button>
                            </div>
                        </form>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Thông Tin Công Việc</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Phòng Ban</label>
                                <input class="form-control" type="text" value="{{$pbis->ten_phong_ban}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Vị Trí</label>
                                <input class="form-control" type="text" value="{{$vitris->ten_vi_tri}}" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Lương</label>
                                <input class="form-control" type="text" value="{{$luong->tien_luong}}" readonly>
                            </div>
                            <div class="row">
                                <a href="{{ route('lich-su-luong') }}"> <i>Xem lịch sử lương</i> </a>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Đổi Mật Khẩu</p>
                    <form action="{{ route('store-nhanvien-dc') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pass_old" class="form-control-label">Mật khẩu cũ</label>
                                    <input class="form-control" name="pass_old" type="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pass_new" class="form-control-label">Mật khẩu mới</label>
                                    <input class="form-control" name="pass_new" type="password">
                                </div>
                            </div>
                        </div>
                        <div class="card-header pb-0">
                            <div class="align-items-center">
                                <p class="mb-0">Ấn để Lưu Mật Khẩu Mới:</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
