@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Chi tiết đơn xin phép</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Nhân viên: {{ $don->nhanVien->ho ?? '' }} {{ $don->nhanVien->ten ?? '' }}</h5>
            <p class="card-text">Email: {{ $don->nhanVien->email ?? '' }}</p>
            <p class="card-text">Loại nghỉ: <b>{{ $don->loai_nghi == 'co_luong' ? 'Có lương' : 'Không lương' }}</b></p>
            <p class="card-text">Ngày bắt đầu: {{ $don->ngay_bat_dau }}</p>
            <p class="card-text">Ngày kết thúc: {{ $don->ngay_ket_thuc }}</p>
            <p class="card-text">Lý do: {{ $don->ly_do }}</p>
            <p class="card-text">Trạng thái: <b>{{ ucfirst(str_replace('_', ' ', $don->trang_thai)) }}</b></p>
            @if($don->trang_thai == 'tu_choi')
                <p class="card-text text-danger">Lý do từ chối: {{ $don->ly_do_tu_choi }}</p>
            @endif
            @if($don->loai_nghi == 'co_luong')
                <p class="card-text">Số ngày nghỉ phép có lương đã dùng trong năm: <b>{{ $soNgayDaNghi }}</b> / 12</p>
            @endif
        </div>
    </div>
    @if($don->trang_thai == 'cho_duyet')
    <form action="{{ route('admin.don_xin_phep.approve', $don->id) }}" method="POST" style="display:inline-block">
        @csrf
        <button class="btn btn-success" onclick="return confirm('Duyệt đơn này?')">Duyệt</button>
    </form>
    <button class="btn btn-danger" onclick="showRejectModal({{ $don->id }})">Từ chối</button>
    @endif
    <a href="{{ route('admin.don_xin_phep.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
<!-- Modal từ chối -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="rejectForm" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Từ chối đơn xin phép</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="ly_do_tu_choi" class="form-label">Lý do từ chối</label>
            <textarea name="ly_do_tu_choi" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-danger">Từ chối</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
function showRejectModal(id) {
    var form = document.getElementById('rejectForm');
    form.action = "{{ route('admin.don_xin_phep.reject', ':id') }}".replace(':id', id);
    var modal = new bootstrap.Modal(document.getElementById('rejectModal'));
    modal.show();
}
</script>
@endsection 