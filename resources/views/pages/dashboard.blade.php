@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Trang chủ'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Số lượng nhân viên</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $countNV }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">Cập nhật gần nhất</span>
                                        {{ $nvlast }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Số vị trí</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $countVT }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">Cập nhật gần nhất</span>
                                        {{ $vtlast }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Số phòng ban</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $countVT }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">Cập nhật gần nhất</span>
                                        {{ $vtlast }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Số lượng Admin</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $countUser }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">Cập nhật gần nhất</span>
                                        {{ $userlast }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Số Nhân Viên Mới</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold"></span> trong năm 2023
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-carousel overflow-hidden h-100 p-0">
                    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner border-radius-lg h-100">
                            <div class="carousel-item h-100 active" style="background-image: url('https://tuyendung.topcv.vn/bai-viet/wp-content/uploads/2022/08/nganh-quan-ly-nhan-su-1.jpg');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Hệ Thống quản trị nhân viên</h5>
                                    <p>Quản trị nhân viên dễ dàng, thống kê thông tin nhân viên</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('https://tuyendung.topcv.vn/bai-viet/wp-content/uploads/2022/08/nganh-quan-ly-nhan-su-1.jpg');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Hệ Thống quản trị nhân viên</h5>
                                    <p>Quản trị nhân viên dễ dàng, thống kê thông tin nhân viên</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('https://tuyendung.topcv.vn/bai-viet/wp-content/uploads/2022/08/nganh-quan-ly-nhan-su-1.jpg');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-trophy text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Hệ Thống quản trị nhân viên</h5>
                                    <p>Quản trị nhân viên dễ dàng, thống kê thông tin nhân viên</p>/div>
                            </div>
                            {{-- <div class="carousel-item h-100" style="background-image: url('https://images.ctfassets.net/szez98lehkfm/5Hi3dsIjVOcad2oNJXhSLF/d5f1afaa7da4d5563ec6b7952e67d361/MyIC_Inline_71502');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-trophy text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Hệ Thống quản trị nhân viên</h5>
                                    <p>Quản trị nhân viên dễ dàng, thống kê thông tin nhân viên</p>/div>
                            </div> --}}
                        </div>
                        <button class="carousel-control-prev w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Card Thống kê lương tổng -->
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Tổng lương</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($tongLuong, 0, ',', '.') }} VNĐ
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                    <i class="ni ni-credit-card text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Thống kê lương trung bình -->
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Lương trung bình</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($luongTrungBinh, 0, ',', '.') }} VNĐ
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-secondary shadow-secondary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bảng thống kê lương theo phòng ban -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Thống kê lương theo phòng ban</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phòng ban</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số nhân viên</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tổng lương</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lương trung bình</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($luongTheoPhongBan as $pb)
                                    <tr>
                                        <td>{{ $pb->ten_phong_ban }}</td>
                                        <td>{{ $pb->so_nv }}</td>
                                        <td>{{ number_format($pb->tong_luong, 0, ',', '.') }} VNĐ</td>
                                        <td>{{ number_format($pb->tb_luong, 0, ',', '.') }} VNĐ</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Biểu đồ thống kê lương theo tháng (toàn bộ nhân viên) -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Thống kê lương theo tháng (toàn bộ nhân viên)</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-luong-theo-thang" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Biểu đồ thống kê lương theo tháng cho từng phòng ban -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Thống kê lương theo tháng cho từng phòng ban</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-luong-theo-thang-phong-ban" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Biểu đồ thống kê nhân viên từng phòng ban -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Thống kê nhân viên từng phòng ban</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-nhan-vien-phong-ban" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Biểu đồ thống kê nhân viên theo giới tính -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Thống kê nhân viên theo giới tính</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-nhan-vien-gioi-tinh" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Biểu đồ thống kê nhân viên theo tuổi -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Thống kê nhân viên theo tuổi</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-nhan-vien-tuoi" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Biểu đồ thống kê theo giới tính theo từng phòng ban -->
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">people</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Thống kê theo giới tính theo phòng ban</p>
                    </div>
                </div>
                <div class="card-body p-3">
                    <canvas id="chart-gioi-tinh-phong-ban" height="300"></canvas>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        let t=`{{$thang}}`;
        let s=`{{$listcountnhanvien}}`;
        t=t.split(',');
        s=s.split(',');
        console.log(t);
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: t,
                datasets: [{
                    label: "Nhân viên",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: s,
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        // Biểu đồ thống kê lương theo tháng (toàn bộ nhân viên)
        var ctxLuongTheoThang = document.getElementById("chart-luong-theo-thang").getContext("2d");
        var gradientStrokeLuongTheoThang = ctxLuongTheoThang.createLinearGradient(0, 230, 0, 50);
        gradientStrokeLuongTheoThang.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStrokeLuongTheoThang.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStrokeLuongTheoThang.addColorStop(0, 'rgba(251, 99, 64, 0)');
        let thangLuong = `{{$thangLuong}}`.split(',');
        let tongLuongTheoThang = `{{$tongLuongTheoThang}}`.split(',');
        new Chart(ctxLuongTheoThang, {
            type: "line",
            data: {
                labels: thangLuong,
                datasets: [{
                    label: "Tổng lương",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStrokeLuongTheoThang,
                    borderWidth: 3,
                    fill: true,
                    data: tongLuongTheoThang,
                    maxBarThickness: 6
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        // Biểu đồ thống kê lương theo tháng cho từng phòng ban (biểu đồ tròn)
        var ctxLuongTheoThangPhongBan = document.getElementById("chart-luong-theo-thang-phong-ban").getContext("2d");
        let luongTheoThangPhongBanData = @json($luongTheoThangPhongBanData);
        let datasets = [];
        let colors = ['#fb6340', '#2dce89', '#11cdef', '#8965e0', '#f5365c'];
        let i = 0;
        for (let phongBan in luongTheoThangPhongBanData) {
            let data = luongTheoThangPhongBanData[phongBan];
            let totalLuong = data.reduce((sum, item) => sum + item.tong_luong, 0);
            datasets.push({
                label: phongBan,
                data: [totalLuong],
                backgroundColor: colors[i % colors.length],
                borderWidth: 0
            });
            i++;
        }
        new Chart(ctxLuongTheoThangPhongBan, {
            type: "pie",
            data: {
                labels: Object.keys(luongTheoThangPhongBanData),
                datasets: [{
                    data: datasets.map(d => d.data[0]),
                    backgroundColor: datasets.map(d => d.backgroundColor),
                    borderWidth: 0
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                    }
                },
            },
        });

        // Biểu đồ thống kê nhân viên từng phòng ban (biểu đồ cột)
        var ctxNhanVienPhongBan = document.getElementById("chart-nhan-vien-phong-ban").getContext("2d");
        let nhanVienPhongBanData = @json($nhanVienPhongBan);
        let labels = nhanVienPhongBanData.map(item => item.ten_phong_ban);
        let data = nhanVienPhongBanData.map(item => item.so_nv);
        let colorsNV = ['#fb6340', '#2dce89', '#11cdef', '#8965e0', '#f5365c'];
        new Chart(ctxNhanVienPhongBan, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Số nhân viên",
                    data: data,
                    backgroundColor: colorsNV.slice(0, labels.length),
                    borderWidth: 0
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });

        // Biểu đồ thống kê nhân viên theo giới tính
        var ctxNhanVienGioiTinh = document.getElementById("chart-nhan-vien-gioi-tinh").getContext("2d");
        let nhanVienGioiTinhData = @json($nhanVienGioiTinh);
        let labelsGT = nhanVienGioiTinhData.map(item => item.gioi_tinh);
        let dataGT = nhanVienGioiTinhData.map(item => item.so_nv);
        let colorsGT = ['#fb6340', '#2dce89'];
        new Chart(ctxNhanVienGioiTinh, {
            type: "pie",
            data: {
                labels: labelsGT,
                datasets: [{
                    data: dataGT,
                    backgroundColor: colorsGT.slice(0, labelsGT.length),
                    borderWidth: 0
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                    }
                },
            },
        });

        // Biểu đồ thống kê nhân viên theo tuổi
        var ctxNhanVienTuoi = document.getElementById("chart-nhan-vien-tuoi").getContext("2d");
        let nhanVienTuoiData = @json($nhanVienTuoi);
        let labelsTuoi = nhanVienTuoiData.map(item => item.tuoi);
        let dataTuoi = nhanVienTuoiData.map(item => item.so_nv);
        let colorsTuoi = ['#fb6340', '#2dce89', '#11cdef', '#8965e0', '#f5365c'];
        new Chart(ctxNhanVienTuoi, {
            type: "bar",
            data: {
                labels: labelsTuoi,
                datasets: [{
                    label: "Số nhân viên",
                    data: dataTuoi,
                    backgroundColor: colorsTuoi.slice(0, labelsTuoi.length),
                    borderWidth: 0
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });

        // Biểu đồ thống kê theo giới tính theo từng phòng ban
        const ctxGioiTinhPhongBan = document.getElementById('chart-gioi-tinh-phong-ban').getContext('2d');
        new Chart(ctxGioiTinhPhongBan, {
            type: 'bar',
            data: {
                labels: @json($nhanVienGioiTinhPhongBan['labels']),
                datasets: [
                    {
                        label: 'Nam',
                        data: @json($nhanVienGioiTinhPhongBan['nam']),
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Nữ',
                        data: @json($nhanVienGioiTinhPhongBan['nu']),
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Khác',
                        data: @json($nhanVienGioiTinhPhongBan['khac']),
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
