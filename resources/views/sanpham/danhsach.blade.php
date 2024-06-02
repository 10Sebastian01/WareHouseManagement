@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý sản phẩm</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Quản lý sản phẩm</li>
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

                                                <a href="{{ route('sanpham.them') }}" class="btn btn-success">Thêm mới</a>

                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Nhập Excel</button>
                                            <button type="button" class="btn btn-success">
                                                <a href="{{ route('sanpham.xuat') }}" class="text-white">
                                                    Xuất Excel
                                                </a>
                                            </button>
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
                            <div class="card-body table-responsive p-0" style="height: 500px;">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                    <tr  style="background-color: blue">
                                        <th>#</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Danh mục</th>
                                        <th>Nhóm thuốc</th>
                                        <th>Phân loại dược</th>
                                        <th>Hoạt chất</th>
                                        <th>Đơn vị tính</th>
                                        <th>Cách dùng</th>
                                        <th>Kê đơn</th>
                                        <th>Hãng sản xuất</th>
                                        <th>Nhà cung cấp</th>
                                        <th>Quốc gia</th>
                                        <th>Giá nhập</th>
                                        <th>Giá xuất</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sanpham as $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->tenthuoc }}</td>
                                            <td>{{ $value->DanhMucSanPham->tendanhmuc }}</td>
                                            <td>{{ $value->NhomThuoc->tennhomthuoc }}</td>
                                            <td>{{ $value->PhanLoaiDuoc->tenloai }}</td>
                                            <td>{{ $value->hoatchat }}</td>
                                            <td>{{ $value->DonViTinh->dvt }}</td>
                                            <td>{{ $value->CachDung->duongdung }}</td>

                                            <td>
                                                @if($value->kedon == 'co')
                                                    <span class="badge bg-success">Có</span>
                                                @else
                                                    <span class="badge bg-danger">Không</span>
                                                @endif
                                            </td>

                                            <td>{{ $value->HangSanXuat->tenhangsanxuat }}</td>
                                            <td>{{ $value->NhaCungCap->tennhacungcap }}</td>
                                            <td>{{ $value->quocgia }}</td>

                                            <td>{{ $value->gianhap }}</td>
                                            <td>{{ $value->giaxuat }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <a href="{{ route('sanpham.sua', ['id' => $value->id]) }}"><i class="nav-icon fas fa-edit"></i></a>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <a href="{{ route('sanpham.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa hàng này không?')"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <!-- Phân trang -->
                            <div class="card-footer">

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

    {{--Input excel area--}}
    <form action="{{ route('sanpham.nhap') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nhập file excel thông tin thuốc</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="exampleInputFile" onchange="displayFileName()">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <script>
                            function displayFileName() {
                                var inputFile = document.getElementById('exampleInputFile');
                                var fileName = inputFile.files[0].name;
                                var label = document.querySelector('.custom-file-label');
                                label.textContent = fileName;
                            }
                        </script>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Nhập</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('search_sanpham_jv')
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

