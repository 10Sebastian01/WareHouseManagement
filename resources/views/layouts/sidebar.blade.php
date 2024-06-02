
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('public/dist/img/kd365.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

                @guest()
                @else
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                <div class="image">
                                    <img src="{{ asset('public/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
                                </div>
                                <div class="info">
                                    <a class="d-block">{{ Auth::user()->name }}</a>
                                </div>
                        </div>
                @endguest


        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item" id="myDropdown">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-capsules"></i>
                        <p>
                            Thuốc
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sanpham') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thuốc</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('danhmuc') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nhomthuoc') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nhóm thuốc</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('phanloaiduoc') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Phân loại dược</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('donvitinh') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đơn vị tính</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cachdung') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đường dùng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('trangthai') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tình trạng</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Kho
                            <i class="right fas fa-angle-left"></i>
                            @if($sanPhamHetHang == 0)
                            @else
                                <span class="badge badge-danger right">{{ $sanPhamHetHang }}</span>
                            @endif
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Đơn hàng<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('nhapkho') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Nhập kho</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('xuatkho') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Xuất kho</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tonkho') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tồn kho
                                    @if($sanPhamHetHang == 0)
                                    @else
                                        <span class="badge badge-danger right">{{ $sanPhamHetHang }}</span>
                                    @endif
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kiemkho') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Phiếu kiếm kho</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="myDropdown">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon far fa-handshake"></i>
                        <p>
                            Đối tác
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('hangsanxuat') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Hãng sản xuất</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('nhacungcap') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Nhà cung cấp</p>
                        </a>
                    </li>
                </ul>
                </li>

                <li class="nav-item">
                <a href="{{ route('khachhang') }}" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                  <p>
                    Khách hàng
                  </p>
                </a>
                </li>
                @if( Auth::user()->isAdmin == 1 )
                    <li class="nav-item">
                        <a href="{{ route('nguoidung') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Tài khoản
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('thongke') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Thống kê
                            </p>
                        </a>
                    </li>
                @endif

              <li class="nav-item">
                @guest
                @else
                    <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-door-open"></i>
                                <p> Đăng xuất</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                @csrf
                            </form>
                    </li>
                    @endguest
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

