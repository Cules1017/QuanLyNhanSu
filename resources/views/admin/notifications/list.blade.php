@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Danh sách thông báo đã gửi'])
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10 col-md-12 col-12">
            <div class="card mb-4 shadow" style="max-width: 1000px; margin: auto;">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Danh sách thông báo đã gửi</h6>
                </div>
                <div class="card-body px-4 pt-3 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Loại</th>
                                    <th>Ngày gửi</th>
                                    <th>Số người nhận</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notifications as $item)
                                <tr>
                                    <td>{{ $item->tieu_de }}</td>
                                    <td>{{ $item->loai == 'mail' ? 'Email' : 'In-app' }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $item->targets_count }}</td>
                                    <td>
                                        <a href="{{ route('admin.notifications.detail', $item->id) }}" class="btn btn-sm btn-info">Xem chi tiết</a>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center">Không có thông báo nào.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection 