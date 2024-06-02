@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý khách hàng</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('khachhang') }}">Quản lý khách hàng</a></li>
                            <li class="breadcrumb-item active">Sửa</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="col-md">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Sửa thông tin khách hàng</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('khachhang.sua', ['id' => $khachhang->id]) }}" method="post">
                        @csrf
                        <div class="card-body">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên khách hàng</label>
                                        <input type="text" class="form-control @error('tenkh') is-invalid @enderror" id="tenkh" name="tenkh"  placeholder="Tên khách hàng" value="{{ $khachhang->tenkh }}" required />
                                        @error('tenkh')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Số điện thoại</label>
                                            <input type="text" class="form-control @error('sodienthoai') is-invalid @enderror" value="{{ $khachhang->sodienthoai }}" placeholder="Số điện thoại" id="sodienthoai" name="sodienthoai">
                                            @error('sodienthoai')
                                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Địa chỉ</label>
                                            <input type="text" class="form-control" value="{{ $khachhang->diachi }}" placeholder="Địa chỉ" id="diachi" name="diachi">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Sửa</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
