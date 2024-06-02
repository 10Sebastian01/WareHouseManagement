
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">Trang chủ</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('nhapkho.them') }}" class="nav-link">Thêm đơn nhập kho</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('xuatkho.them') }}" class="nav-link">Thêm đơn xuất kho</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('sanpham') }}" class="nav-link">Thuốc</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('tonkho') }}" class="nav-link">Tồn kho
                @if($sanPhamHetHang == 0)
                @else
                    <span class="badge badge-danger navbar-badge">{{ $sanPhamHetHang }}</span>
                @endif
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
