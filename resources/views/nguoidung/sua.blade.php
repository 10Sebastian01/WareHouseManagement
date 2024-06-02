@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý tài khoản người dùng</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('nguoidung') }}">Quản lý tài khoản</a></li>
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
                        <h3 class="card-title">Sửa thông tin tài khoản</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('nguoidung.sua', ['id' => $nguoidung->id]) }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="name">Tên</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  placeholder="Tên người dùng" value="{{ $nguoidung->name }}" required />
                                        @error('name')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ $nguoidung->email }}" required>
                                        @error('email')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password">Mật khẩu mới</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"  placeholder="Mật khẩu" value="{{ old('password') }}" required >
                                        @error('password')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password_confirmation">Xác nhận lại mật khẩu *</label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Xác nhận mật khẩu" id="password_confirmation" name="password_confirmation" required >
                                        @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Sửa</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
