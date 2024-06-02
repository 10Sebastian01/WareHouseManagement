@extends('layouts.app')
@section('form_themsanpham_head')
    <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm sản phẩm</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('sanpham') }}">Quản lý sản phẩm</a></li>
                            <li class="breadcrumb-item active">Thêm</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- SELECT2 EXAMPLE -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thêm thuốc</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('sanpham.them') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- ten thuoc -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" class="form-control @error('tenthuoc') is-invalid @enderror" id="tenthuoc" name="tenthuoc"  placeholder="Tên thuốc" value="{{ old('tenthuoc') }}" required />
                                        @error('tenthuoc')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <label>Đơn vị tính</label>
                                            <select class="form-control select2" id="donvitinh_id" name="donvitinh_id" required style="width: 100%;">
                                                <option value="">--Chọn--</option>
                                                @foreach($dvt as $value)
                                                    <option value="{{ $value->id }}">{{ $value->dvt }}</option>
                                                @endforeach
                                            </select>
                                            @error('donvitinh_id')
                                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label>Đường dùng</label>
                                            <select class="form-control select2" id="cachdung_id" name="cachdung_id" required style="width: 100%;">
                                                <option value="">--Chọn--</option>
                                                @foreach($cachdung as $value)
                                                    <option value="{{ $value->id }}">{{ $value->duongdung }}</option>
                                                @endforeach
                                            </select>
                                            @error('cachdung_id')
                                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Hoạt chất</label>
                                            <input type="text" class="form-control" id="hoatchat" name="hoatchat"  placeholder="Hoạt chất"/>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- danh muc -->

                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Danh mục</label>
                                                <select class="form-control select2" id="danhmucsanpham_id" name="danhmucsanpham_id" required style="width: 100%;">
                                                    <option value="">Chọn danh mục ---</option>
                                                    @foreach($dmsp as $value)
                                                        <option value="{{ $value->id }}">{{ $value->tendanhmuc }}</option>
                                                    @endforeach
                                                </select>
                                                @error('danhmucsanpham_id')
                                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-3"> <br>&emsp;
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="radioPrimary1" name="kedon" value="co" checked>
                                                    <label for="radioPrimary1"> Kê đơn &emsp;
                                                    </label>
                                                </div>

                                        </div>
                                        <div class="col-md-3"><br>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioPrimary2" name="kedon" value="khong">
                                                <label for="radioPrimary2"> Không kê đơn
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Nhóm thuốc</label>
                                        <select class="form-control select2" id="nhomthuoc_id" name="nhomthuoc_id" required style="width: 100%;">
                                            <option value="">Chọn nhóm thuốc ---</option>
                                            @foreach($nhomthuoc as $value)
                                                <option value="{{ $value->id }}">{{ $value->tennhomthuoc }}</option>
                                            @endforeach
                                        </select>
                                        @error('nhomthuoc_id')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Quốc gia</label>
                                                <input type="text" class="form-control" placeholder="Quốc gia" id="quocgia" name="quocgia">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Giá nhập (VND)</label>
                                                <input type="number" class="form-control" placeholder="Giá nhập" id="gianhap" name="gianhap">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleInputPassword1">Giá xuất (VND)</label>
                                            <input type="number" class="form-control" placeholder="Giá xuất" id="giaxuat" name="giaxuat">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Hãng sản xuất</label>
                                                <select class="form-control select2" id="hangsanxuat_id" name="hangsanxuat_id" required style="width: 100%;">
                                                    <option value="">Chọn hãng sản xuất ---</option>
                                                    @foreach($hsx as $value)
                                                        <option value="{{ $value->id }}">{{ $value->tenhangsanxuat }}</option>
                                                    @endforeach
                                                </select>
                                                @error('hangsanxuat_id')
                                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                                @enderror
                                            </div>
                                        </div>
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

                                    </div>

                                    <!-- /.form-group -->

                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phân loại dược</label>
                                        <select class="form-control select2" id="phanloaiduoc_id" name="phanloaiduoc_id" required style="width: 100%;">
                                            <option value="">Chọn phân loại dược ---</option>
                                            @foreach($phanloaiduoc as $value)
                                                <option value="{{ $value->id }}">{{ $value->tenloai }}</option>
                                            @endforeach
                                        </select>
                                        @error('phanloaiduoc_id')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Số lượng</label>
                                            <input type="number" class="form-control" placeholder="Số lượng">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->


                                    <!-- /.form-group -->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

<!-- jQuery -->
@section('form_themsanpham_scripts')
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ asset('public/plugins/select2/js/select2.full.min.js')}}"></script>

    <!-- AdminLTE App -->
    <!-- AdminLTE for demo purposes -->
    <!-- Page specific script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection



