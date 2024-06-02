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
                            <li class="breadcrumb-item active">Quản lý tài khoản người dùng</li>
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
                                                <a href="{{ route('nguoidung.them') }}" class="btn btn-success">Thêm mới</a>
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
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Vai trò</th>
                                        <th colspan="3">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($nguoidung as $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>
                                                @if($value->isAdmin == '0')
                                                    <span class="badge bg-warning">Nhân viên</span>
                                                @else
                                                    <span class="badge bg-primary">Quản trị</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('nguoidung.doivaitro', ['id' => $value->id]) }}"><i class="nav-icon fas fa-sync-alt"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{ route('nguoidung.sua', ['id' => $value->id]) }}"><i class="nav-icon fas fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{ route('nguoidung.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa người dùng này không?')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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
