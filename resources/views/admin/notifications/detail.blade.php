@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Chi tiết thông báo đã gửi'])
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10 col-md-12 col-12">
            <div class="card mb-4 shadow" style="max-width: 1000px; margin: auto;">
                <div class="card-header pb-0">
                    <h6 class="mb-0">{{ $notification->tieu_de }}</h6>
                </div>
                <div class="card-body px-4 pt-3 pb-2">
                    <div class="mb-3">
                        <strong>Loại:</strong> {{ $notification->loai == 'mail' ? 'Email' : 'In-app' }}<br>
                        <strong>Ngày gửi:</strong> {{ $notification->created_at->format('d/m/Y H:i') }}<br>
                        <strong>Nội dung:</strong>
                        <div class="border rounded p-3 bg-light mt-2">{!! nl2br(e($notification->noi_dung)) !!}</div>
                    </div>
                    <h6 class="mt-4">Danh sách nhân viên nhận thông báo</h6>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Phòng ban</th>
                                    <th>Vị trí</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($targets as $item)
                                <tr>
                                    <td>{{ $item->nhanVien->ho ?? '' }} {{ $item->nhanVien->ten ?? '' }}</td>
                                    <td>{{ $item->nhanVien->email ?? '' }}</td>
                                    <td>{{ $item->nhanVien->phongBan->ten_phong_ban ?? '' }}</td>
                                    <td>{{ $item->nhanVien->viTri->ten_vi_tri ?? '' }}</td>
                                    <td>
                                        @if($item->da_xem)
                                            <span class="badge bg-success">Đã đọc</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Chưa đọc</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center">Không có nhân viên nhận thông báo này.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection 