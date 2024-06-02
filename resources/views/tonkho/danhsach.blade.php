@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý tồn kho</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Quản lý tồn kho</li>
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
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <b>Tổng tồn hiện tại: <span class="badge bg-danger">{{ $tongton }}</span></b>
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
                            <div class="card-body">
                                <table id="example1" class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên thuốc</th>
                                        <th>Danh mục</th>
                                        <th>Đơn vị tính</th>
                                        <th>Tổng số lượng tồn</th>
                                        <th>Chi tiết</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($groupedData as $value)
                                        <tr>
                                            <td>{{ $loop->index + $groupedData->firstItem() }}</td>
                                            <td>{{ $value->SanPham->tenthuoc }}</td>
                                            <td>{{ $value->tendanhmuc }}</td>
                                            <td>{{ $value->dvt }}</td>
                                            <td>
                                                @if($value->tongtonkho > 0)
                                                    <span class="badge bg-warning">{{ $value->tongtonkho }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ $value->tongtonkho }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($value->tongtonkho == 0)
                                                    <a class="btn btn-success btn-sm" href="{{ route('nhapkho.them') }}">
                                                        <i class="fas fa-plus-circle"></i>  Thêm hàng
                                                    </a>
                                                @else
                                                    <a class="btn btn-primary btn-sm"  onclick="layChiTietTon({{ $value->sanpham_id }})" href="#" data-toggle="modal" data-target="#modal-xl">
                                                        <i class="fas fa-info-circle"></i></i> Chi tiết
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Phân trang -->
                            <div class="card-footer">
                                {{ $groupedData->links() }}
                            </div>
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
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chi tiết tồn kho</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold text-center" id="titleTenSP"></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped text-center">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Số lô</th>
                                    <th>Số lượng</th>
                                    <th>Hạn sử dụng</th>
                                </tr>
                                </thead>
                                <tbody id="tbBD">

                                <tr>
                                    <td>1.</td>
                                    <td>Update software</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-warning">55%</span></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts_DStonkho')
<script>
    function layChiTietTon(sanpham_id){
        $('#tbBD').empty();
        var stt = 1;
        $.ajax({
            url: '{{ route('lay.tonkhochitiet') }}', // Đường dẫn tới route xử lý
            type: 'get',
            data: {
                sanpham_id: sanpham_id // Dữ liệu cần gửi lên server
            },
            success: function(response){
                $('#titleTenSP').text(response.tenthuoc);
                response.mangchitietton.forEach(function(chiTiet) {
                    var row = '<tr>' +
                        '<td>' + stt++  + '</td>' +
                        '<td>' + chiTiet.solo + '</td>' +
                        '<td>' + chiTiet.soluong + '</td>' +
                        '<td>' + '<span class="badge bg-warning">' + chiTiet.ngayhh + '</span>' + '</td>' +
                        '</tr>';
                    $('#tbBD').append(row);
                });
                $('#modal-default').modal('show');
            },
            error: function(xhr, status, error){
                // Xử lý lỗi nếu có
                console.error(error);
            }
        });
    }
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
