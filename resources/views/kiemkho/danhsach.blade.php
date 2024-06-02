@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý kiểm kho</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Quản lý kiểm kho</li>
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
                                                <a href="{{ route('kiemkho.them') }}" class="btn btn-success">Thêm phiếu kiểm kho</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
                                        <th>Mã phiếu</th>
                                        <th>Người tạo</th>
                                        <th>Ngày kiểm</th>
                                        <th>Ghi chú</th>
                                        <th>Trạng thái</th>
                                        @if(auth()->user()->isAdmin == 1)
                                            <th>Duyệt</th>
                                        @endif
                                        <th>Xem chi tiết</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($kiemkho as $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->maphieukiem }}</td>
                                            <td>{{ $value->NguoiDung->name }}</td>
                                            <td>{{ $value->ngaykiem}}</td>
                                            <td>{{ $value->ghichu }}</td>
                                            <td>
                                                @if($value->TrangThai->ten == 'Chưa duyệt')
                                                    <span class="badge badge-danger">Chưa duyệt</span>
                                                @else
                                                    <span class="badge badge-warning">Đã duyệt</span>
                                                @endif
                                            </td>
                                            @if(auth()->user()->isAdmin == 1)
                                                <td>
                                                    <div class="col-md-12">
                                                        @if($value->TrangThai->ten == 'Chưa duyệt')
                                                            <a href="{{ route('kiemkho.duyet', ['id' => $value->id]) }}"><i class="fas fa-check-circle"></i></a>
                                                        @else
                                                            <a href="{{ route('kiemkho.boduyet', ['id' => $value->id]) }}"><i class="fas fa-times-circle"></i></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="col-md-12">
                                                    <a class="btn btn-primary btn-sm"  onclick="openModal({{ $value->id }})" href="#" data-toggle="modal" data-target="#modal-xl">
                                                        <i class="fas fa-info-circle"></i>
                                                        </i>
                                                        Chi tiết
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
                                {{ $kiemkho->links() }}
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
                    <h4 class="modal-title">
                        Chi tiết phiếu kiểm kho
                    </h4>
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
                                <h4 class="text-center">PHIẾU KIỂM KHO</h4>
                            </div>
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <!-- /.col -->
                            <div class="col-sm-6 invoice-col">
                                <span>Mã đơn: </span><b id="maphieu"></b><br>
                                <b>Người kiểm: </b> <span id="nguoikiem"></span><br>
                                <b>Ngày tạo phiếu: </b> <span id="ngaytao"></span><br>
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
                                        <th>Số lượng tồn</th>
                                        <th>Số lượng thực tế</th>
                                        <th>Chênh lệch</th>
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
@section('jv_chitietphieukiemkho')
    <script>
        function openModal(id){
            $.ajax({
                url: "{{ route('kiemkho.xemchitiet', ['id' => ':id']) }}".replace(':id', id),
                type: 'GET',
                success: function(response) {
                    // Hiển thị dữ liệu lấy được lên modal
                    $('#maphieu').text(response.maphieu);
                    $('#nguoikiem').text(response.tennguoikiem);
                    $('#ngaytao').text(response.ngaytao);
                    //$('#tong').text(response.tongtien);
                    $('#tableBody').empty();
                    var stt = 1;
                    response.mangchitietDH.forEach(function(chiTiet) {
                        var row = '<tr>' +
                            '<td>' + stt++  + '</td>' +
                            '<td>' + chiTiet.tensanpham + '</td>' +
                            '<td>' + chiTiet.solo + '</td>' +
                            '<td>' + chiTiet.tendonvitinh + '</td>' +
                            '<td>' + chiTiet.ngayhethan + '</td>' +
                            '<td>' + chiTiet.soluonght + '</td>' +
                            '<td>' + chiTiet.soluongtt + '</td>' +
                            '<td>' + chiTiet.chenhlech + '</td>' +
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
