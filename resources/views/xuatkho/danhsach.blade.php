@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý xuất kho</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Quản lý xuất kho</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <!-- Nhập, xuất, tìm kiếm -->
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dt-button btn-group flex-wrap" >
                                                <a href="{{ route('xuatkho.them') }}" class="btn btn-success">Thêm mới</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="input-group">
                                            <input type="search" placeholder="Tìm kiếm" class="form-control" id="searchSP" name="searchSP">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-search"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày tạo</th>
                                        <th>Người tạo</th>
                                        <th>Khách hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ghi chú</th>
                                        @if(auth()->user()->isAdmin == 1)
                                            <th>Duyệt</th>
                                        @endif
                                        <th width="10%">Chi tiết</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($donxuat as $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->madon }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ $value->NguoiDung->name }}</td>
                                            <td>{{ $value->KhachHang->tenkh }}</td>
                                            <td>
                                                @if($value->TrangThai->ten == 'Chưa duyệt')
                                                    <span class="badge badge-danger">Chưa duyệt</span>
                                                @else
                                                    <span class="badge badge-success">Đã duyệt</span>
                                                @endif
                                            </td>
                                            <td>{{ $value->ghichu }}</td>
                                            @if(auth()->user()->isAdmin == 1)
                                                <td>
                                                    <div class="col-md-12">
                                                        @if($value->TrangThai->ten == 'Chưa duyệt')
                                                            <a href="{{ route('xuatkho.duyet', ['id' => $value->id]) }}"><i class="fas fa-check-circle"></i></a>
                                                        @else
                                                            <a href="{{ route('xuatkho.boduyet', ['id' => $value->id]) }}"><i class="fas fa-times-circle"></i></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="col-sm-12">
                                                    <a class="btn btn-primary btn-sm"  onclick="openModal({{ $value->id }})" href="#" data-toggle="modal" data-target="#modal-xl">
                                                        <i class="fas fa-info-circle"></i></i> Chi tiết
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Phân trang -->
                            <div class="card-footer">
                                {{ $donxuat->links() }}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chi tiết đơn hàng</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <img src="{{ asset('public/img/medicine.png') }}"> Kho Dược 365
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="text-center">ĐƠN HÀNG XUẤT KHO</h4>
                                </div>
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <!-- /.col -->
                                <div class="col-sm-6 invoice-col">
                                    <span>Mã đơn: </span><b id="madon"></b><br>
                                    <b>Khách hàng: </b> <span id="kh_id"></span><br>
                                    <b>Người xuất: </b> <span id="nguoixuat"></span><br>
                                    <b>Ngày tạo đơn: </b> <span id="ngaytao"></span><br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped" id="example1">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="40%">Tên thuốc</th>
                                            <th>Số lô</th>
                                            <th>Đơn vị tính</th>
                                            <th>Ngày hết hạn</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tableBody">

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">
                                    <p class="lead">Ghi chú:</p>
                                    <p id="ghichu" class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    </p>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Tổng tiền:</th>
                                                <td id="tong"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>

                        </div>
                    </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <div class="dt-button btn-group flex-wrap">
                        <a href="#" onclick="print_current_page()" class="btn btn-block bg-gradient-success"><i class="fas fa-print"></i>    In đơn</a>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('jv_chitietdhxuat')
    <script>
        function openModal(id){
            $.ajax({
                url: "{{ route('xuatkho.xemchitiet', ['id' => ':id']) }}".replace(':id', id), // Đường dẫn đến route xử lý việc lấy dữ liệu chi tiết đơn hàng
                type: 'GET',
                success: function(response) {
                    // Hiển thị dữ liệu lấy được lên modal
                    $('#kh_id').text(response.tenkh);
                    $('#madon').text(response.id);
                    $('#ghichu').text(response.ghichu);
                    $('#nguoixuat').text(response.nguoixuat);
                    $('#ngaytao').text(response.ngaytao);
                    $('#tong').text(response.tongtien.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                    $('#tableBody').empty();
                    var stt = 1;
                    response.mangchitietDH.forEach(function(chiTiet) {
                        var row = '<tr>' +
                            '<td>' + stt++  + '</td>' +
                            '<td>' + chiTiet.tensanpham + '</td>' +
                            '<td>' + chiTiet.solo + '</td>' +
                            '<td>' + chiTiet.tendonvitinh + '</td>' +
                            '<td>' + chiTiet.ngayhethan + '</td>' +
                            '<td>' + chiTiet.soluong + '</td>' +
                            '<td>' + chiTiet.thanhtien.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }) + '</td>' +
                            '</tr>';
                        $('#tableBody').append(row);
                    });
                    // Mở modal

                    console.log(response);
                    $('#modal-xl').modal('show');
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi nếu có
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    <script>
        function print_current_page() {
            // Lấy nội dung của modal-body
            var printContents = document.getElementById('modal-xl').querySelector('.modal-body').innerHTML;

            // Tạo một cửa sổ mới để hiển thị nội dung in
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;

            // In nội dung
            window.print();

            // Khôi phục nội dung ban đầu của trang web
            document.body.innerHTML = originalContents;
        }
    </script>
    <script>
        $(document).ready(function(){
            $("#searchSP").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                if (value === "") {
                    // Nếu hộp văn bản rỗng, hiển thị lại tất cả các hàng trong bảng
                    $("#example1 tr").show();
                } else {
                    // Nếu không, lọc và hiển thị các hàng tương ứng với giá trị tìm kiếm
                    $("#example1 tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                }
            });
        });
    </script>
@endsection
