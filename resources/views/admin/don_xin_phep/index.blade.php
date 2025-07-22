@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Đơn xin phép'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Danh sách đơn xin phép</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <form method="GET" class="row g-3 mb-3 px-3">
                                <div class="col-auto">
                                    <select name="trang_thai" class="form-select">
                                        <option value="">-- Trạng thái --</option>
                                        <option value="cho_duyet" {{ request('trang_thai')=='cho_duyet'?'selected':'' }}>Chờ duyệt</option>
                                        <option value="da_duyet" {{ request('trang_thai')=='da_duyet'?'selected':'' }}>Đã duyệt</option>
                                        <option value="tu_choi" {{ request('trang_thai')=='tu_choi'?'selected':'' }}>Từ chối</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select name="loai_nghi" class="form-select">
                                        <option value="">-- Loại nghỉ --</option>
                                        <option value="co_luong" {{ request('loai_nghi')=='co_luong'?'selected':'' }}>Có lương</option>
                                        <option value="khong_luong" {{ request('loai_nghi')=='khong_luong'?'selected':'' }}>Không lương</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary">Lọc</button>
                                </div>
                            </form>
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nhân viên</th>
                                        <th>Loại nghỉ</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($donXinPheps as $don)
                                    <tr>
                                        <td>{{ $don->id }}</td>
                                        <td>{{ $don->nhanVien->ho ?? '' }} {{ $don->nhanVien->ten ?? '' }}</td>
                                        <td>{{ $don->loai_nghi == 'co_luong' ? 'Có lương' : 'Không lương' }}</td>
                                        <td>{{ $don->ngay_bat_dau }}</td>
                                        <td>{{ $don->ngay_ket_thuc }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $don->trang_thai)) }}</td>
                                        <td>
                                            <a href="{{ route('admin.don_xin_phep.show', $don->id) }}" class="btn btn-info btn-sm">Xem</a>
                                            @if($don->trang_thai == 'cho_duyet')
                                            <form action="{{ route('admin.don_xin_phep.approve', $don->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                <button class="btn btn-success btn-sm" onclick="return confirm('Duyệt đơn này?')">Duyệt</button>
                                            </form>
                                            <button class="btn btn-danger btn-sm" onclick="showRejectModal({{ $don->id }})">Từ chối</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Không có đơn xin phép nào</td>
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