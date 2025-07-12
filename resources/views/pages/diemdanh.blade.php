@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
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
                                        <form action="{{ route('diem-danh') }}" method="GET" class="row g-3">
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
    </div>
@endsection 