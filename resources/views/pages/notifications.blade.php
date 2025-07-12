@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10 col-md-12 col-12">
            <div class="card mb-4 shadow" style="max-width: 1000px; margin: auto;">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Danh sách thông báo</h6>
                </div>
                <div class="card-body px-4 pt-3 pb-2">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Loại</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày gửi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notifications as $item)
                                <tr>
                                    <td>{{ $item->notification->tieu_de ?? '' }}</td>
                                    <td>{{ $item->notification->loai == 'mail' ? 'Email' : 'In-app' }}</td>
                                    <td>
                                        @if($item->da_xem)
                                            <span class="badge bg-success">Đã đọc</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Chưa đọc</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('user.notifications.show', $item->id) }}" class="btn btn-sm btn-info">Xem</a>
                                        @if(!$item->da_xem)
                                        <form action="{{ route('user.notifications.markAsRead', $item->id) }}" method="POST" style="display:inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success ms-1">Đánh dấu đã đọc</button>
                                        </form>
                                        @endif
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
            <div class="text-center mt-3">
                <a href="{{ route('xem-nhanvien-dc') }}" class="btn btn-secondary">Về trang chủ</a>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection 