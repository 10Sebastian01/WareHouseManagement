@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thống kê</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Thống kê</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                            <!-- Nhập, xuất, tìm kiếm -->
                                <div class="row">
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>{{ $tongslton }}</h3>

                                                <p>Tổng số hàng hiện tồn kho</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-pills"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-success">
                                            <div class="inner">
                                                <h3>{{ number_format($tongGiaTri, 0, ',', '.') }}₫</h3>

                                                <p>Tổng giá trị kho</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-warning">
                                            <div class="inner">
                                                <h3>{{ $tongSoLuongXuat }}</h3>

                                                <p>Tổng lượng hàng đã xuất</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-boxes"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-danger">
                                            <div class="inner">
                                                <h3>{{ $soDonHangMoi }}</h3>

                                                <p>Số đơn hàng hôm nay</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-receipt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">Thống kê số đơn hàng tháng này</h3>
{{--                                            <a href="javascript:void(0);">View Report</a>--}}
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <p class="d-flex flex-column">
                                                <span class="text-bold text-lg">{{ $tongsldon }}</span>
                                                <span>Tổng số đơn tháng này</span>
                                            </p>

                                        </div>
                                        <!-- /.d-flex -->
                                        <div class="position-relative mb-4">
                                            <canvas id="visitors-chart" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Info Boxes Style 2 -->
                                <div class="info-box mb-3 bg-warning">
                                    <span class="info-box-icon"><i class="fas fa-cubes"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Tổng sản phẩm kho quản lý</span>
                                        <span class="info-box-number">{{ $tongsp }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                                <div class="info-box mb-3 bg-success">
                                    <span class="info-box-icon"><i class="fas fa-people-carry"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Nhân sự</span>
                                        <span class="info-box-number">{{ $tongnhansu }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                                <div class="info-box mb-3 bg-danger">
                                    <span class="info-box-icon"><i class="fas fa-user-tie"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Khách hàng</span>
                                        <span class="info-box-number">{{ $tongkh }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                                <div class="info-box mb-3 bg-info">
                                    <span class="info-box-icon"><i class="fas fa-address-book"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Nhà cung cấp</span>
                                        <span class="info-box-number">{{ $tongncc }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
@endsection
@section('bieudo')
    <script src="{{ asset('public/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        const ctx = document.getElementById('visitors-chart');

        fetch('{{ route('thongke.bieudo')}}')
            .then(response => response.json())
            .then(data => {
                const dataNhap = data.dataNhap.reduce((acc, curr) => {
                    acc[curr.day] = curr.total;
                    return acc;
                }, {});
                const dataXuat = data.dataXuat.reduce((acc, curr) => {
                    acc[curr.day] = curr.total;
                    return acc;
                }, {});

                // Lấy ngày đầu tiên và ngày cuối cùng của tháng hiện tại
                const soNgayTrongThang = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: Array.from({ length: soNgayTrongThang }, (_, i) => i + 1),
                        datasets: [{
                            label: 'Nhập kho',
                            data: Array.from({ length: soNgayTrongThang }, (_, i) => dataNhap[i + 1] || 0),
                            borderWidth: 1,
                            borderColor: '#FF0000',
                        }, {
                            label: 'Xuất kho',
                            data: Array.from({ length: soNgayTrongThang }, (_, i) => dataXuat[i + 1] || 0),
                            borderWidth: 1,
                            borderColor: '#36A2EB',
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value, index, values) {
                                        return Math.floor(value); // Làm tròn giá trị xuống số nguyên
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
@endsection
