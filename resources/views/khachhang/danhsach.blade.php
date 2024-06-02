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
                            <li class="breadcrumb-item active">Quản lý khách hàng</li>
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
                                                <a href="{{ route('khachhang.them') }}" class="btn btn-success">Thêm mới</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th width="10%">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($khachhang as $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->tenkh }}</td>
                                            <td>{{ $value->sodienthoai }}</td>
                                            <td>{{ $value->diachi }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <a href="{{ route('khachhang.sua', ['id' => $value->id]) }}"><i class="nav-icon fas fa-edit"></i></a>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <a href="{{ route('khachhang.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa khách hàng này không?')"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <!-- Phân trang -->
                            <div class="row">

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
@endsection

