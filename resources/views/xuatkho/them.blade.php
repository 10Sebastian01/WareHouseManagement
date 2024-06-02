@extends('layouts.app')
@section('form_themphieuXK_head')
    <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <link rel="stylesheet" href="{{ asset('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection
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
                        <li class="breadcrumb-item"><a href="{{ route('xuatkho') }}">Quản lý xuất kho</a></li>
                        <li class="breadcrumb-item active">Thêm phiếu xuất kho</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-md">
            <form action="#" method="POST" id="orderForm">
                @csrf

                <fieldset>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin đơn hàng</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Khách hàng</label>
                                        <select class="form-control select2" id="kh_id" name="kh_id" required style="width: 100%;">
                                            <option value="">Chọn khách hàng ---</option>
                                            @foreach($kh as $value)
                                                <option value="{{ $value->id }}">{{ $value->tenkh }}</option>
                                            @endforeach
                                        </select>
                                        @error('kh_id')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Số điện thoại</label>
                                        <input type="text" disabled class="form-control" placeholder="Số điện thoại" id="sodienthoai" name="sodienthoai">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Địa chỉ</label>
                                        <input type="text" class="form-control" placeholder="Địa chỉ" id="diachi" name="diachi" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ghi chú đơn hàng</label>
                                        <input type="text" class="form-control" placeholder="Ghi chú" id="ghichu" name="ghichu">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="card card-secondary" id="groupContainer">
                        <div class="card-header">
                            <h3 class="card-title">Đơn hàng chi tiết</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card card-warning" id="firstCard">
                            <div class="card-body" id="childCard">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Sản phẩm</label>
                                            <select class="form-select form-control" aria-label="Default select example" id="sanpham_id" name="sanpham_id" style="width: 100%;">
                                                <option value="">Chọn sản phẩm ---</option>
                                                @foreach($tonkho as $value)
                                                    <option value="{{ $value->sanpham_id }}">{{ $value->SanPham->tenthuoc }}</option>
                                                @endforeach
                                            </select>
                                            @error('sanpham_id')
                                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="solo">Số lượng hiện tồn</label>
                                            <input type="number" class="form-control" id="slht" name="slht"  placeholder="Số lượng hàng hiện tồn" disabled/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="donvitinh_id">Đơn vị tính</label>
                                            <input type="text" class="form-control"  id="donvitinh_id" name="donvitinh_id" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="soluong">Số lượng</label>
                                            <input type="number" class="form-control" id="soluong" name="soluong"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="gianhap">Giá xuất</label>
                                            <input type="text" class="form-control" id="giaxuat" name="giaxuat" disabled placeholder="Giá xuất"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="thanhtien">Thành tiền</label>
                                            <input type="text" class="form-control" id="thanhtien" name="thanhtien" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="orderDetailsTable" class="table table-bordered text-center">
                                <thead>
                                <tr>
                                    <th width="30%">Tên sản phẩm</th>
                                    <th>Giá xuất</th>
                                    <th>Dvt</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Hành động</th>

                                </tr>
                                </thead>
                                <tbody>
                                <!-- Các hàng sẽ được thêm vào đây bằng JavaScript -->
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <a id="addProductButton" class="btn btn-warning">Thêm hàng</a>
                            <button type="submit" class="btn btn-info swalDefaultInfo" style="float: right;">Xác nhận đơn hàng</button>

                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </section>
</div>
@endsection
@section('form_themphieuXK_scripts')
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ asset('public/plugins/select2/js/select2.full.min.js')}}"></script>

    <script src="{{ asset('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script src="{{ asset('public/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- AdminLTE App -->
    <!-- AdminLTE for demo purposes -->
    <!-- Page specific script -->
    <script>
        var currentDate = new Date();
        $('#reservationdate').datetimepicker({
            format: 'L',
            minDate: currentDate
        });
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
        document.getElementById("soluong").addEventListener("input", function() {
            // Lấy giá trị của ô số lượng
            var soluong = parseFloat(this.value);

            // Lấy giá trị của ô giá nhập
            var giaxuat = parseFloat(document.getElementById("giaxuat").value);

            // Tính toán thành tiền
            var thanhtien = soluong * giaxuat;

            // Cập nhật giá trị của ô thành tiền
            document.getElementById("thanhtien").value = thanhtien;
        });
    </script>
    <script>
        $('#kh_id').change(function() {
            var value = $(this).val(); // Lấy giá trị của thẻ select khi thay đổi
            getKhachHang(value); // Gọi hàm xử lý khi có sự thay đổi
        });
        function getKhachHang(value) {
            $.ajax({
                type: 'get',
                url: '{{ route('lay.ttkh') }}',
                data: {
                    tenkh: value,
                },
                success: function(response) {
                    $('#sodienthoai').val(response.sdt);
                    $('#diachi').val(response.diachi);
                    //console.log(response);
                    //console.log('Value:', value);
                },
                error: function() {
                    alert('Lỗi');
                }
            });
        }
    </script>
    <script>
        $('#sanpham_id').change(function() {
            var value = $(this).val(); // Lấy giá trị của thẻ select khi thay đổi
            getSLTon(value); // Gọi hàm xử lý khi có sự thay đổi
        });
        function getSLTon(value) {
            $.ajax({
                type: 'get',
                url: '{{ route('lay.slton') }}',
                data: {
                    idthuoc: value,
                },
                success: function(response) {
                    $('#donvitinh_id').val(response.dvt);
                    $('#giaxuat').val(response.giaxuat);
                    $('#slht').val(response.slt);
                },
                error: function() {
                    alert('Lỗi');
                }
            });
        }
    </script>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $(document).ready(function() {
            // sukiennutthemhang
            $("#addProductButton").click(function() {
                if ($("#sanpham_id").prop('selectedIndex') === 0 ||
                    $("#soluong").val() === '' ||
                    $("#slht").val() === '' ||
                    $("#donvitinh_id").val() === '' ||
                    $("#gianhap").val() === '' ||
                    $("#thanhtien").val() === '')
                {
                    // Nếu có ít nhất một trường rỗng, hiển thị thông báo
                    Toast.fire({
                        icon: 'warning',
                        title: 'Vui lòng nhập đầy đủ thông tin của thuốc !'
                    })
                } else {
                    var selectedProductId = $("#sanpham_id").val();
                    var $slht = parseInt($('#soluong').val());
                    var $sltk = parseInt($('#slht').val());
                    if($slht <= $sltk)
                    {
                        // Lấy thông tin sản phẩm từ các phần tử nhập liệu
                        var tensp = $('#sanpham_id').find('option:selected').text();
                        var soluong = $("#soluong").val();
                        var donvitinh = $("#donvitinh_id").val();
                        var giaxuat = $("#giaxuat").val();
                        var thanhtien = $("#thanhtien").val();
                        // Thêm hàng mới vào bảng
                        var newRow = "<tr>" +
                            "<td>" + tensp + "</td>" +
                            "<td>" + giaxuat + "</td>" +
                            "<td>" + donvitinh + "</td>" +
                            "<td>" + soluong + "</td>" +
                            "<td>" + thanhtien + "</td>" +
                            '<td><a href="#" class="xoaDongLink"><i class="fas fa-trash"></i></a></td>' +
                            "</tr>";
                        $("#orderDetailsTable tbody").append(newRow);
                        $(document).on('click', '.xoaDongLink', function(e) {
                            e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

                            var productName = $(this).closest('tr').find('td:first').text();

                            $("#sanpham_id").append("<option value='" + selectedProductId + "'>" + productName + "</option>");

                            $(this).closest('tr').remove(); // Xóa dòng chứa liên kết được click
                        });
                        $("#sanpham_id").prop('selectedIndex', 0);
                        $("#soluong").val('');
                        $("#slht").val('');
                        $("#donvitinh_id").val('');
                        $("#giaxuat").val('');
                        $("#thanhtien").val('');
                        $("#sanpham_id option[value='" + selectedProductId + "']").remove();
                    }else
                    {
                        Toast.fire({
                            icon: 'info',
                            title: 'Số lượng xuất vượt quá số lượng hiện tồn trong kho! Vui lòng chọn lại số lượng'
                        })
                    }

                }
            });

            // Lắng nghe sự kiện click nút "Xác nhận đơn hàng"
            $('#orderForm').on('submit', function(event) {
                event.preventDefault(); // Ngăn chặn việc gửi form mặc định

                // Lấy số lượng hàng trong table
                var numberOfItems = $('#orderDetailsTable tbody tr').length;
                // Kiểm tra nếu số lượng hàng bằng 0
                if (numberOfItems === 0) {
                        Toast.fire({
                            icon: 'info',
                            title: 'Vui lòng thêm thông tin thuốc cần nhập vào bảng bên dưới!'
                        })
                } else {
                    var danhSachSanPham = [];
                    // Lặp qua từng hàng trong bảng
                    $('#orderDetailsTable tbody tr').each(function() {
                        var tenSanPham = $(this).find('td:first').text();
                        var giaXuat = $(this).find('td:nth-child(2)').text();
                        var donViTinh = $(this).find('td:nth-child(3)').text();
                        var soLuong = $(this).find('td:nth-child(4)').text();
                        var thanhTien = $(this).find('td:nth-child(5)').text();

                        // Tạo một đối tượng chứa thông tin sản phẩm
                        var sanPham = {
                            tenSanPham: tenSanPham,
                            giaXuat: giaXuat,
                            donViTinh: donViTinh,
                            soLuong: soLuong,
                            thanhTien: thanhTien,
                        };

                        danhSachSanPham.push(sanPham);
                        console.log(danhSachSanPham);
                    });
                    // Gửi mảng danhSachSanPham đến máy chủ để xử lý
                    var khachhang = $('#kh_id').val();
                    var ghichu = $('#ghichu').val();

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('xuatkho.them') }}',
                        data:
                            JSON.stringify({
                                danhSachSanPham: danhSachSanPham,
                                khachhang: khachhang,
                                ghichu: ghichu
                            }),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        contentType: 'application/json',
                        success: function(response)
                        {
                            console.log(response);
                            Toast.fire({
                                icon: 'success',
                                title: 'Đơn hàng đã được thêm thành công.'
                            })
                            setTimeout(function() {
                                window.location.href = '{{ route('xuatkho') }}';
                            }, 3000);
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            console.log(errorMessage);
                            alert('Đã xảy ra lỗi khi gửi đơn hàng!');
                        }
                    });
                }


            });

        });

    </script>
@endsection

