@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý đường dùng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cachdung') }}">Quản lý đường dùng</a></li>
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
                    <h3 class="card-title">Thêm cách dùng</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('cachdung.them') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên đường dùng</label>
                            <input type="text" class="form-control @error('duongdung') is-invalid @enderror" id="duongdung" name="duongdung"  placeholder="Đường dùng" value="{{ old('duongdung') }}" required />
                            @error('duongdung')
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
