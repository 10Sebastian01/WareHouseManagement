@extends('layouts.app')
@section('form_themphieuNK_head')
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
                    <h1>Quản lý nhập kho</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('nhapkho') }}">Quản lý nhập kho</a></li>
                        <li class="breadcrumb-item active">Thêm phiếu nhập kho</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-md">
            <form action="{{ route('nhapkho.them') }}" method="POST" id="orderForm">
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
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Nhà cung cấp</label>
                                        <select class="form-control select2" id="nhacungcap_id" name="nhacungcap_id" required style="width: 100%;">
                                            <option value="">Chọn nhà cung cấp ---</option>
                                            @foreach($ncc as $value)
                                                <option value="{{ $value->id }}">{{ $value->tennhacungcap }}</option>
                                            @endforeach
                                        </select>
                                        @error('nhacungcap_id')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Ghi chú</label>
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
                                                @foreach($sp as $value)
                                                    <option value="{{ $value->id }}">{{ $value->tenthuoc }}</option>
                                                @endforeach
                                            </select>
                                            @error('sanpham_id')
                                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Ngày hết hạn</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" id="ngayhethan" name="ngayhethan" data-target="#reservationdate"/>
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="solo">Số lô</label>
                                            <input type="number" class="form-control @error('dvt') is-invalid @enderror" id="solo" name="solo"  placeholder="Số lô sản xuất"/>
                                            @error('dvt')
                                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                            @enderror
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
                                            <label for="gianhap">Giá nhập</label>
                                            <input type="text" class="form-control" id="gianhap" name="gianhap" disabled placeholder="Giá nhập"/>
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
                                    <th>Số lô</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Giá nhập</th>
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
@section('form_themphieuNK_scripts')
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
            var gianhap = parseFloat(document.getElementById("gianhap").value);

            // Tính toán thành tiền
            var thanhtien = soluong * gianhap;

            // Cập nhật giá trị của ô thành tiền
            document.getElementById("thanhtien").value = thanhtien;
        });
    </script>
    <script>
        $('#sanpham_id').change(function() {
            var value = $(this).val(); // Lấy giá trị của thẻ select khi thay đổi
            getDonViTinh(value); // Gọi hàm xử lý khi có sự thay đổi
        });
        function getDonViTinh(value) {
            $.ajax({
                type: 'get',
                url: '{{ route('lay.donvitinh') }}',
                data: {
                    tenthuoc: value,
                },
                success: function(data) {
                    $('#donvitinh_id').val(data.donvitinh_id);
                    $('#gianhap').val(data.gianhap);
                    //console.log(data);
                    //console.log('Value:', value);
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
        // Đợi cho trang web được tải hoàn toàn
        $(document).ready(function() {
            // Lắng nghe sự kiện click nút "Thêm hàng"
            $("#addProductButton").click(function() {
                if ($("#sanpham_id").prop('selectedIndex') === 0 ||
                    $("#soluong").val() === '' ||
                    $("#ngayhethan").val() === '' ||
                    $("#solo").val() === '' ||
                    $("#donvitinh_id").val() === '' ||
                    $("#gianhap").val() === '' ||
                    $("#thanhtien").val() === '') {
                    // Nếu có ít nhất một trường rỗng, hiển thị thông báo
                    Toast.fire({
                        icon: 'warning',
                        title: 'Vui lòng nhập đầy đủ thông tin của thuốc !'
                    })
                } else {
                    // Lấy thông tin sản phẩm từ các phần tử nhập liệu
                    var tensp = $('#sanpham_id').find('option:selected').text();
                    var soluong = $("#soluong").val();
                    var ngayhh = $("#ngayhethan").val();
                    var solo = $("#solo").val();
                    var donvitinh = $("#donvitinh_id").val();
                    var gianhap = $("#gianhap").val();
                    var thanhtien = $("#thanhtien").val();
                    // Thêm hàng mới vào bảng
                    var newRow = "<tr>" +
                        "<td>" + tensp + "</td>" +
                        "<td>" + solo + "</td>" +
                        "<td>" + ngayhh + "</td>" +
                        "<td>" + gianhap + "</td>" +
                        "<td>" + donvitinh + "</td>" +
                        "<td>" + soluong + "</td>" +
                        "<td>" + thanhtien + "</td>" +
                        '<td><a href="#" class="xoaDongLink"><i class="fas fa-trash"></i></a></td>' +
                        "</tr>";
                    $("#orderDetailsTable tbody").append(newRow);
                    $(document).on('click', '.xoaDongLink', function(e) {
                        e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                        $(this).closest('tr').remove(); // Xóa dòng chứa liên kết được click
                    });
                    $("#sanpham_id").prop('selectedIndex', 0);
                    $("#soluong").val('');
                    $("#ngayhethan").val('');
                    $("#solo").val('');
                    $("#donvitinh_id").val('');
                    $("#gianhap").val('');
                    $("#thanhtien").val('');
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
                        var soLo = $(this).find('td:nth-child(2)').text();
                        var ngayHetHan = $(this).find('td:nth-child(3)').text();
                        var giaNhap = $(this).find('td:nth-child(4)').text();
                        var donViTinh = $(this).find('td:nth-child(5)').text();
                        var soLuong = $(this).find('td:nth-child(6)').text();
                        var thanhTien = $(this).find('td:nth-child(7)').text();

                        // Tạo một đối tượng chứa thông tin sản phẩm
                        var sanPham = {
                            tenSanPham: tenSanPham,
                            soLo: soLo,
                            ngayHetHan: ngayHetHan,
                            giaNhap: giaNhap,
                            donViTinh: donViTinh,
                            soLuong: soLuong,
                            thanhTien: thanhTien,
                            // Thêm thông tin nhà cung cấp
                        };

                        // Thêm đối tượng sản phẩm vào mảng danhSachSanPham
                        danhSachSanPham.push(sanPham);
                        console.log(danhSachSanPham);
                    });
                    // Gửi mảng danhSachSanPham đến máy chủ để xử lý
                    var nhacungcap = $('#nhacungcap_id').val();
                    var ghichu = $('#ghichu').val();

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('nhapkho.them') }}',
                        data:
                            JSON.stringify({
                                danhSachSanPham: danhSachSanPham,
                                nhacungcapId: nhacungcap,
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
                                window.location.href = '{{ route('nhapkho') }}';
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

