@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9 col-md-11 col-12">
            <div class="card mb-4 shadow" style="max-width: 800px; margin: auto;">
                <div class="card-header pb-0">
                    <h6 class="mb-0">{{ $target->notification->tieu_de ?? 'Thông báo' }}</h6>
                </div>
                <div class="card-body px-4 pt-3 pb-2">
                    <div class="mb-3">
                        <strong>Loại:</strong> {{ $target->notification->loai == 'mail' ? 'Email' : 'In-app' }}<br>
                        <strong>Người gửi:</strong> {{ $target->notification->nguoi_gui_id ?? 'Hệ thống' }}<br>
                        <strong>Ngày gửi:</strong> {{ $target->created_at->format('d/m/Y H:i') }}<br>
                        <strong>Trạng thái:</strong>
                        @if($target->da_xem)
                            <span class="badge bg-success">Đã đọc</span>
                        @else
                            <span class="badge bg-warning text-dark">Chưa đọc</span>
                        @endif
                    </div>
                    <div class="mb-4">
                        <strong>Nội dung:</strong>
                        <div class="border rounded p-3 bg-light mt-2">{!! nl2br(e($target->notification->noi_dung ?? '')) !!}</div>
                    </div>
                    @if(!$target->da_xem)
                    <form action="{{ route('user.notifications.markAsRead', $target->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Đánh dấu đã đọc</button>
                    </form>
                    @endif
                    <a href="{{ route('user.notifications.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection 