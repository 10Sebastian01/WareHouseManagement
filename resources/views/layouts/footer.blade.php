<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Bản quyền &copy; {{ date('Y') }} bởi {{ config('app.name', 'Laravel') }}.</strong>
</footer>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>

@yield('form_themsanpham_scripts')
@yield('form_suasanpham_scripts')
@yield('form_themphieuNK_scripts')
@yield('form_themphieuXK_scripts')
@yield('jv_chitietdhnhap')
@yield('jv_chitietdhxuat')
@yield('jv_chitietphieukiemkho')
@yield('scripts_DStonkho')
@yield('form_themphieuKK_scripts')
@yield('search_sanpham_jv')
@yield('bieudo')




