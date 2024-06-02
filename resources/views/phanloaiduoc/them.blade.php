@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Phân loại dược</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('phanloaiduoc') }}">Phân loại dược</a></li>
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
                        <h3 class="card-title">Thêm phân loại</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('phanloaiduoc.them') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên loại</label>
                                <input type="text" class="form-control @error('tenloai') is-invalid @enderror" id="tenloai" name="tenloai"  placeholder="Tên loại" value="{{ old('tenloai') }}" required />
                                @error('tenloai')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ghi chú</label>
                                <input type="text" class="form-control" placeholder="Ghi chú" id="ghichu" name="ghichu">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
