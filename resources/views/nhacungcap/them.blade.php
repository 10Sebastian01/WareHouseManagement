@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý nhà cung cấp</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('nhacungcap') }}">Quản lý nhà cung cấp</a></li>
                        <li class="breadcrumb-item active">Thêm</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-md">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm nhà cung cấp</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('nhacungcap.them') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                                    <input type="text" class="form-control @error('tennhacungcap') is-invalid @enderror" id="tennhacungcap" name="tennhacungcap"  placeholder="Tên nhà cung cấp" value="{{ old('tennhacungcap') }}" required />
                                    @error('tennhacungcap')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên viết tắt</label>
                                    <input type="text" class="form-control" placeholder="Tên viết tắt" id="tenviettat" name="tenviettat">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã số thuế</label>
                                    <input type="text" class="form-control @error('masothue') is-invalid @enderror" id="masothue" name="masothue"  placeholder="Mã số thuế" value="{{ old('masothue') }}" required />
                                    @error('masothue')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại</label>
                                    <input type="text" class="form-control @error('sodienthoai') is-invalid @enderror" placeholder="Số điện thoại nhà cung cấp" id="sodienthoai" name="sodienthoai">
                                    @error('sodienthoai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ</label>
                                    <input type="text" class="form-control" placeholder="Địa chỉ nhà cung cấp" id="diachi" name="diachi">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info swalDefaultInfo">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

