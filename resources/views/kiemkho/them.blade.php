@extends('layouts.app')
@section('form_themphieuKK_head')
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
                        <h1>Quản lý kiểm kho</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kiemkho') }}">Quản lý kiểm kho</a></li>
                            <li class="breadcrumb-item active">Thêm</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="col-md">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start phieukiemkho_id	sanpham_id	losx_id	ngayhethan	soluongtonkho	soluongthucte-->
                    <form action="{{ route('kiemkho.them') }}" method="POST" id="orderForm">
                        @csrf

                        <fieldset>
                            <div class="card card-secondary" id="groupContainer">
                                <div class="card-header">
                                    <h3 class="card-title">Thông tin phiếu kiểm</h3>
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
                                                <div class="form-group">
                                                    <label>Ngày hết hạn</label>
                                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                        <input disabled type="text" class="form-control datetimepicker-input" id="ngayhethan" name="ngayhethan" data-target="#reservationdate"/>
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
                                                    <label for="solo">Chọn lô sản phẩm</label>
                                                    <select onchange="chonSoLo()" disabled class="form-select form-control" aria-label="Default select example" id="solo" name="solo" style="width: 100%;">
                                                       <!-- Đổ số lô dô đây qua JV -->
                                                    </select>
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
                                                    <label for="soluong">Số lượng hiện tồn</label>
                                                    <input disabled type="number" class="form-control" id="soluonght" name="soluonght"/>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="soluong">Số lượng thực tế</label>
                                                    <input type="number" class="form-control" id="soluongtt" name="soluongtt"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="soluong">Chênh lệch</label>
                                                    <input disabled type="number" class="form-control" id="chenhlech" name="chenhlech"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Ghi chú</label>
                                                    <input type="text" class="form-control" placeholder="Ghi chú" id="ghichu" name="ghichu">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="orderDetailsTable" class="table table-bordered text-center">
                                                <thead>
                                                <tr>
                                                    <th width="30%">Tên sản phẩm</th>
                                                    <th>Số lô</th>
                                                    <th>Ngày hết hạn</th>
                                                    <th>Đơn vị</th>
                                                    <th>Số lượng hiện tồn</th>
                                                    <th>Số lượng thực tế</th>
                                                    <th>Chênh lệch</th>
                                                    <th>Hành động</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <!-- Các hàng sẽ được thêm vào đây bằng JavaScript -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <a id="addProductButton" class="btn btn-warning">Thêm hàng</a>
                                    <button type="submit" class="btn btn-info swalDefaultInfo" style="float: right;">Xác nhận phiếu</button>

                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('form_themphieuKK_scripts')
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
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
        document.getElementById("soluongtt").addEventListener("input", function() {
            // Lấy giá trị của ô số lượng
            var thucte = parseFloat(this.value);

            // giá trị số lượng hiện tồn
            var hienton = parseFloat(document.getElementById("soluonght").value);

            var chenhlech = thucte - hienton;

            // Cập nhật giá trị của ô thành tiền
            document.getElementById("chenhlech").value = chenhlech;
        });
    </script>
    <script> // Toàn bộ sự kiện trong form nhập thông tin thuốc để kiểm kho
        $('#sanpham_id').change(function() {
            var value = $(this).val(); // Lấy giá trị của thẻ select khi thay đổi
             // Gọi hàm xử lý khi có sự thay đổi
            console.log(value);
            var selectSolo = document.getElementById("solo");

            if (value === "") {
                $('#donvitinh_id').val('');
                selectSolo.disabled = true; // Kích hoạt thẻ select số lô
            } else {
                // AJAX
                    var a1 = $.ajax({
                            type: 'get',
                            url: '{{ route('lay.spkt') }}',
                            data: {
                                idthuoc: value,
                        }
                        }),
                        a2 = $.ajax({
                            type: 'get',
                            url: '{{ route('lay.slsp') }}',
                            data: {
                                idthuoc: value,
                            }
                        });

                        $.when(a1, a2).done(function(response1, response2){
                            $('#donvitinh_id').val(response1[0].donvitinh.dvt);
                            console.log(response1);
                            $('#solo').empty();
                            $('#solo').append('<option value="">Chọn lô sản phẩm ---</option>');
                            response2[0].mangsolo.forEach(function(data) {
                                $('#solo').append('<option value="' + data.id + '">' + data.solo + '</option>');
                            });

                            console.log(response2[0]);
                        });
                selectSolo.disabled = false; // Vô hiệu hóa thẻ select số lô
            }
        });

        function chonSoLo(){ // Chọn lô sẽ đổ qua số lượng hiện tồn và ngày hết hạn của lô đó
            var solo_id = document.getElementById("solo").value;
            if(solo_id === ''){

            }
            else {
                var aSolo = $.ajax({
                    type: 'get',
                    url:'{{ route('lay.soluongsl') }}',
                    data: {'idsolo': solo_id,}
                });
                $.when(aSolo).done(function (response) {
                    $('#soluonght').val(response.soluong);
                    $('#ngayhethan').val(response.ngayhh);
                })
            }
        }

    </script>
    <script> // Sự kiện 2 nút thêm và xác nhận đơn hàng
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
                    $("#soluonght").val() === '' ||
                    $("#soluongtt").val() === '' ||
                    $("#ngayhethan").val() === '' ||
                    $("#solo").val() === '' ||
                    $("#donvitinh_id").val() === '' ||
                    $("#chenhlech").val() === '') {
                    // Nếu có ít nhất một trường rỗng, hiển thị thông báo
                    Toast.fire({
                        icon: 'warning',
                        title: 'Vui lòng nhập đầy đủ thông tin của thuốc !'
                    })
                } else {
                    // Lấy thông tin sản phẩm từ các phần tử nhập liệu
                    var tensp = $('#sanpham_id').find('option:selected').text();
                    var ht = $("#soluonght").val();
                    var tt = $("#soluongtt").val();
                    var ngayhh = $("#ngayhethan").val();
                    var solo = $("#solo").find('option:selected').text();
                    var donvitinh = $("#donvitinh_id").val();
                    var chenhl = $("#chenhlech").val();
                    // Thêm hàng mới vào bảng
                    var newRow = "<tr>" +
                        "<td>" + tensp + "</td>" +
                        "<td>" + solo + "</td>" +
                        "<td>" + ngayhh + "</td>" +
                        "<td>" + donvitinh + "</td>" +
                        "<td>" + ht + "</td>" +
                        "<td>" + tt + "</td>" +
                        "<td>" + chenhl + "</td>" +
                        '<td><a href="#" class="xoaDongLink"><i class="fas fa-trash"></i></a></td>' +
                        "</tr>";
                    $("#orderDetailsTable tbody").append(newRow);
                    $(document).on('click', '.xoaDongLink', function(e) {
                        e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                        $(this).closest('tr').remove(); // Xóa dòng chứa liên kết được click
                    });
                    $("#sanpham_id").prop('selectedIndex', 0);
                    $("#soluonght").val('');
                    $("#soluongtt").val('');
                    $("#ngayhethan").val('');
                    $("#solo").val('');
                    $("#donvitinh_id").val('');
                    $("#chenhlech").val('');}
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
                        var donViTinh = $(this).find('td:nth-child(4)').text();
                        var slTon = $(this).find('td:nth-child(5)').text();
                        var slThucTe = $(this).find('td:nth-child(6)').text();
                        var chenhLech = $(this).find('td:nth-child(7)').text();

                        // Tạo một đối tượng chứa thông tin sản phẩm
                        var sanPham = {
                            tenSanPham: tenSanPham,
                            soLo: soLo,
                            ngayHetHan: ngayHetHan,
                            donViTinh: donViTinh,
                            slTon: slTon,
                            slThucTe: slThucTe,
                            chenhLech: chenhLech,
                        };
                        danhSachSanPham.push(sanPham);
                        console.log(danhSachSanPham);
                    });
                    var ghichu = $('#ghichu').val();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('kiemkho.them') }}',
                        data:
                            JSON.stringify({
                                danhSachSanPham: danhSachSanPham,
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
                            // Xử lý kết quả trả về từ máy chủ sau khi xác nhận đơn hàng thành
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
