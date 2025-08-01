 
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Đơn xin phép'])
<div class="container-fluid py-4">
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('xem-nhanvien-dc') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Quay về trang thông tin
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tạo đơn xin phép</h6>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('user.don_xin_phep.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="loai_nghi" class="form-label">Loại nghỉ</label>
                            <select name="loai_nghi" id="loai_nghi" class="form-select" required>
                                <option value="">-- Chọn loại nghỉ --</option>
                                <option value="co_luong" {{ old('loai_nghi')=='co_luong'?'selected':'' }}>Có lương</option>
                                <option value="khong_luong" {{ old('loai_nghi')=='khong_luong'?'selected':'' }}>Không lương</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ngay_bat_dau" class="form-label">Ngày bắt đầu</label>
                            <input type="date" name="ngay_bat_dau" id="ngay_bat_dau" class="form-control" value="{{ old('ngay_bat_dau') }}" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="mb-3">
                            <label for="ngay_ket_thuc" class="form-label">Ngày kết thúc</label>
                            <input type="date" name="ngay_ket_thuc" id="ngay_ket_thuc" class="form-control" value="{{ old('ngay_ket_thuc') }}" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="mb-3">
                            <label for="ly_do" class="form-label">Lý do</label>
                            <textarea name="ly_do" id="ly_do" class="form-control" required>{{ old('ly_do') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số ngày phép có lương đã dùng trong năm: <b>{{ $soNgayDaNghi }}</b> / 12</label>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btn-gui-don">Gửi đơn</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Danh sách đơn xin phép đã gửi</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Loại nghỉ</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Lý do</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donXinPheps as $don)
                                <tr>
                                    <td>{{ $don->id }}</td>
                                    <td>{{ $don->loai_nghi == 'co_luong' ? 'Có lương' : 'Không lương' }}</td>
                                    <td>{{ $don->ngay_bat_dau }}</td>
                                    <td>{{ $don->ngay_ket_thuc }}</td>
                                    <td>{{ $don->ly_do }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $don->trang_thai)) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Bạn chưa gửi đơn xin phép nào</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="px-3">
                            {{ $donXinPheps->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
function tinhSoNgay() {
    const start = document.getElementById('ngay_bat_dau').value;
    const end = document.getElementById('ngay_ket_thuc').value;
    if (start && end) {
        const d1 = new Date(start);
        const d2 = new Date(end);
        return Math.floor((d2 - d1) / (1000*60*60*24)) + 1;
    }
    return 0;
}
function checkNgayPhep() {
    const loai = document.getElementById('loai_nghi').value;
    const soNgayConLai = {{ 12 - $soNgayDaNghi }};
    const soNgay = tinhSoNgay();
    const btn = document.getElementById('btn-gui-don');
    const start = document.getElementById('ngay_bat_dau').value;
    const end = document.getElementById('ngay_ket_thuc').value;
    if (end && start && end < start) {
        btn.disabled = true;
        document.getElementById('canhbao-ngay').innerText = 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu!';
        return;
    }
    if (loai === 'co_luong' && soNgay > soNgayConLai) {
        btn.disabled = true;
        document.getElementById('canhbao-ngay').innerText = 'Bạn không đủ ngày phép có lương!';
    } else {
        btn.disabled = false;
        document.getElementById('canhbao-ngay').innerText = '';
    }
}
document.getElementById('loai_nghi').addEventListener('change', checkNgayPhep);
document.getElementById('ngay_bat_dau').addEventListener('change', function() {
    const start = this.value;
    const endInput = document.getElementById('ngay_ket_thuc');
    endInput.min = start;
    if (endInput.value < start) {
        endInput.value = start;
    }
    checkNgayPhep();
});
document.getElementById('ngay_ket_thuc').addEventListener('change', checkNgayPhep);
// Kiểm tra lại khi submit form
const form = document.querySelector('form');
form.addEventListener('submit', function(e) {
    const start = document.getElementById('ngay_bat_dau').value;
    const end = document.getElementById('ngay_ket_thuc').value;
    if (end < start) {
        e.preventDefault();
        document.getElementById('canhbao-ngay').innerText = 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu!';
        document.getElementById('btn-gui-don').disabled = true;
    }
});
</script>
<div id="canhbao-ngay" class="text-danger mb-2"></div> 