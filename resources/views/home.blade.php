@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Trang chủ</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-5 text-center d-flex align-items-center justify-content-center">
                            <div class="">
                                <h2>KHO DƯỢC <strong>365</strong></h2>
                                <p class="lead mb-5">Chào mừng bạn đến với Kho Dược 365 - trang web quản lý kho dược<br>
                                    Vui lòng chọn menu bên trái để điều hướng !
                                </p>
                            </div>
                        </div>
                        <div class="col-7">
                            <img class="img-fluid pad" src="{{ asset('public/img/medicine_home.png') }}">
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- /.content -->
    </div>
@endsection
