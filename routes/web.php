<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhieuKiemKhoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CachDungController;
use App\Http\Controllers\DanhMucSanPhamController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\NhomThuocController;
use App\Http\Controllers\PhanLoaiDuocController;
use App\Http\Controllers\DonViTinhController;
use App\Http\Controllers\HangSanXuatController;
use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\TrangThaiController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\TonKhoController;

Route::get('/', function () {
    return view('home');
});
Auth::routes();
Route::middleware(['auth'])->group(function () {
    // Tất cả các route trong nhóm này đều yêu cầu xác thực người dùng
    Route::get('/', [App\Http\Controllers\HomeController::class, 'getHome'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'getHome'])->name('home');

// Cách dùng
    Route::get('/cachdung', [CachDungController::class, 'getDanhSach'])->name('cachdung');
    Route::get('/cachdung/them', [CachDungController::class, 'getThem'])->name('cachdung.them');
    Route::post('/cachdung/them', [CachDungController::class, 'postThem'])->name('cachdung.them');
    Route::get('/cachdung/sua/{id}', [CachDungController::class, 'getSua'])->name('cachdung.sua');
    Route::post('/cachdung/sua/{id}', [CachDungController::class, 'postSua'])->name('cachdung.sua');
    Route::get('/cachdung/xoa/{id}', [CachDungController::class, 'getXoa'])->name('cachdung.xoa');

// Danh mục sản phẩm
    Route::get('/danhmuc', [DanhMucSanPhamController::class, 'getDanhSach'])->name('danhmuc');
    Route::get('/danhmuc/them', [DanhMucSanPhamController::class, 'getThem'])->name('danhmuc.them');
    Route::post('/danhmuc/them', [DanhMucSanPhamController::class, 'postThem'])->name('danhmuc.them');
    Route::get('/danhmuc/sua/{id}', [DanhMucSanPhamController::class, 'getSua'])->name('danhmuc.sua');
    Route::post('/danhmuc/sua/{id}', [DanhMucSanPhamController::class, 'postSua'])->name('danhmuc.sua');
    Route::get('/danhmuc/xoa/{id}', [DanhMucSanPhamController::class, 'getXoa'])->name('danhmuc.xoa');

// Sanpham
    Route::get('/sanpham', [SanPhamController::class, 'getDanhSach'])->name('sanpham');
    Route::get('/sanpham/them', [SanPhamController::class, 'getThem'])->name('sanpham.them');
    Route::post('/sanpham/them', [SanPhamController::class, 'postThem'])->name('sanpham.them');
    Route::get('/sanpham/sua/{id}', [SanPhamController::class, 'getSua'])->name('sanpham.sua');
    Route::post('/sanpham/sua/{id}', [SanPhamController::class, 'postSua'])->name('sanpham.sua');
    Route::get('/sanpham/xoa/{id}', [SanPhamController::class, 'getXoa'])->name('sanpham.xoa');
    // Nhập xuất excel
    Route::post('/sanpham/nhap', [SanPhamController::class, 'postNhap'])->name('sanpham.nhap');
    Route::get('/sanpham/xuat', [SanPhamController::class, 'getXuat'])->name('sanpham.xuat');
    // Truy xuất đơn vị tính cho lúc thêm đơn hàng chi tiết
    Route::get('/laydonvitinh', [SanPhamController::class, 'getDonViTinh'])->name('lay.donvitinh');



// Nhóm thuốc
    Route::get('/nhomthuoc', [NhomThuocController::class, 'getDanhSach'])->name('nhomthuoc');
    Route::get('/nhomthuoc/them', [NhomThuocController::class, 'getThem'])->name('nhomthuoc.them');
    Route::post('/nhomthuoc/them', [NhomThuocController::class, 'postThem'])->name('nhomthuoc.them');
    Route::get('/nhomthuoc/sua/{id}', [NhomThuocController::class, 'getSua'])->name('nhomthuoc.sua');
    Route::post('/nhomthuoc/sua/{id}', [NhomThuocController::class, 'postSua'])->name('nhomthuoc.sua');
    Route::get('/nhomthuoc/xoa/{id}', [NhomThuocController::class, 'getXoa'])->name('nhomthuoc.xoa');

// Phân loại duợc
    Route::get('/phanloaiduoc', [PhanLoaiDuocController::class, 'getDanhSach'])->name('phanloaiduoc');
    Route::get('/phanloaiduoc/them', [PhanLoaiDuocController::class, 'getThem'])->name('phanloaiduoc.them');
    Route::post('/phanloaiduoc/them', [PhanLoaiDuocController::class, 'postThem'])->name('phanloaiduoc.them');
    Route::get('/phanloaiduoc/sua/{id}', [PhanLoaiDuocController::class, 'getSua'])->name('phanloaiduoc.sua');
    Route::post('/phanloaiduoc/sua/{id}', [PhanLoaiDuocController::class, 'postSua'])->name('phanloaiduoc.sua');
    Route::get('/phanloaiduoc/xoa/{id}', [PhanLoaiDuocController::class, 'getXoa'])->name('phanloaiduoc.xoa');

// Đơn vị tính
    Route::get('/donvitinh', [DonViTinhController::class, 'getDanhSach'])->name('donvitinh');
    Route::get('/donvitinh/them', [DonViTinhController::class, 'getThem'])->name('donvitinh.them');
    Route::post('/donvitinh/them', [DonViTinhController::class, 'postThem'])->name('donvitinh.them');
    Route::get('/donvitinh/sua/{id}', [DonViTinhController::class, 'getSua'])->name('donvitinh.sua');
    Route::post('/donvitinh/sua/{id}', [DonViTinhController::class, 'postSua'])->name('donvitinh.sua');
    Route::get('/donvitinh/xoa/{id}', [DonViTinhController::class, 'getXoa'])->name('donvitinh.xoa');


    // Hãng sản xuất
    Route::get('/hangsanxuat', [HangSanXuatController::class, 'getDanhSach'])->name('hangsanxuat');
    Route::get('/hangsanxuat/them', [HangSanXuatController::class, 'getThem'])->name('hangsanxuat.them');
    Route::post('/hangsanxuat/them', [HangSanXuatController::class, 'postThem'])->name('hangsanxuat.them');
    Route::get('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'getSua'])->name('hangsanxuat.sua');
    Route::post('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'postSua'])->name('hangsanxuat.sua');
    Route::get('/hangsanxuat/xoa/{id}', [HangSanXuatController::class, 'getXoa'])->name('hangsanxuat.xoa');

    // Nhà cung cấp
    Route::get('/nhacungcap', [NhaCungCapController::class, 'getDanhSach'])->name('nhacungcap');
    Route::get('/nhacungcap/them', [NhaCungCapController::class, 'getThem'])->name('nhacungcap.them');
    Route::post('/nhacungcap/them', [NhaCungCapController::class, 'postThem'])->name('nhacungcap.them');
    Route::get('/nhacungcap/sua/{id}', [NhaCungCapController::class, 'getSua'])->name('nhacungcap.sua');
    Route::post('/nhacungcap/sua/{id}', [NhaCungCapController::class, 'postSua'])->name('nhacungcap.sua');
    Route::get('/nhacungcap/xoa/{id}', [NhaCungCapController::class, 'getXoa'])->name('nhacungcap.xoa');

    // Khách hàng
    Route::get('/khachhang', [KhachHangController::class, 'getDanhSach'])->name('khachhang');
    Route::get('/khachhang/them', [KhachHangController::class, 'getThem'])->name('khachhang.them');
    Route::post('/khachhang/them', [KhachHangController::class, 'postThem'])->name('khachhang.them');
    Route::get('/khachhang/sua/{id}', [KhachHangController::class, 'getSua'])->name('khachhang.sua');
    Route::post('/khachhang/sua/{id}', [KhachHangController::class, 'postSua'])->name('khachhang.sua');
    Route::get('/khachhang/xoa/{id}', [KhachHangController::class, 'getXoa'])->name('khachhang.xoa');

    // Trạng thái
    Route::get('/trangthai', [TrangThaiController::class, 'getDanhSach'])->name('trangthai');
    Route::get('/trangthai/them', [TrangThaiController::class, 'getThem'])->name('trangthai.them');
    Route::post('/trangthai/them', [TrangThaiController::class, 'postThem'])->name('trangthai.them');
    Route::get('/trangthai/sua/{id}', [TrangThaiController::class, 'getSua'])->name('trangthai.sua');
    Route::post('/trangthai/sua/{id}', [TrangThaiController::class, 'postSua'])->name('trangthai.sua');
    Route::get('/trangthai/xoa/{id}', [TrangThaiController::class, 'getXoa'])->name('trangthai.xoa');

    Route::middleware(['admin'])->group(function () {
        // Tài khoản người dùng
        Route::get('/nguoidung', [NguoiDungController::class, 'getDanhSach'])->name('nguoidung');
        Route::get('/nguoidung/them', [NguoiDungController::class, 'getThem'])->name('nguoidung.them');
        Route::post('/nguoidung/them', [NguoiDungController::class, 'postThem'])->name('nguoidung.them');
        Route::get('/nguoidung/sua/{id}', [NguoiDungController::class, 'getSua'])->name('nguoidung.sua');
        Route::post('/nguoidung/sua/{id}', [NguoiDungController::class, 'postSua'])->name('nguoidung.sua');
        Route::get('/nguoidung/xoa/{id}', [NguoiDungController::class, 'getXoa'])->name('nguoidung.xoa');
        Route::get('/nguoidung/doivaitro/{id}', [NguoiDungController::class, 'getDoiVaiTro'])->name('nguoidung.doivaitro');

        Route::get('/nhapkho/duyet/{id}', [DonHangController::class, 'getDuyetNhapkho'])->name('nhapkho.duyet');
        Route::get('/nhapkho/boduyet/{id}', [DonHangController::class, 'getBoDuyetNhapkho'])->name('nhapkho.boduyet');

        Route::get('/xuatkho/duyet/{id}', [DonHangController::class, 'getDuyetXuatkho'])->name('xuatkho.duyet');
        Route::get('/xuatkho/boduyet/{id}', [DonHangController::class, 'getBoDuyetXuatkho'])->name('xuatkho.boduyet');
    });

    // Nhập kho
    Route::get('/nhapkho', [DonHangController::class, 'getDanhSachNhapkho'])->name('nhapkho');
    Route::get('/nhapkho/them', [DonHangController::class, 'getThemNhapKho'])->name('nhapkho.them');
    Route::post('/nhapkho/them', [DonHangController::class, 'postThemNhapkho'])->name('nhapkho.them');

    Route::get('/nhapkho/xemchitiet/{id}', [DonHangController::class, 'getXemChiTietNhapKho'])->name('nhapkho.xemchitiet');
    Route::get('/nhapkho/xoa/{id}', [DonHangController::class, 'getXoaNhapkho'])->name('nhapkho.xoa');

    // Xuất kho
    Route::get('/xuatkho', [DonHangController::class, 'getDanhSachXuatkho'])->name('xuatkho');
    Route::get('/xuatkho/them', [DonHangController::class, 'getThemXuatkho'])->name('xuatkho.them');
    Route::post('/xuatkho/them', [DonHangController::class, 'postThemXuatkho'])->name('xuatkho.them');

    Route::get('/xuatkho/xemchitiet/{id}', [DonHangController::class, 'getXemChiTietXuatKho'])->name('xuatkho.xemchitiet');
    Route::get('/xuatkho/xoa/{id}', [DonHangController::class, 'getXoaXuatkho'])->name('xuatkho.xoa');


    Route::get('/layttkh', [KhachHangController::class, 'getKhachHang'])->name('lay.ttkh');


    // Tồn kho
    Route::get('/tonkho', [TonKhoController::class, 'getDanhSach'])->name('tonkho');
    Route::get('/laysoluongton', [TonKhoController::class, 'getSoLuongTonKho'])->name('lay.slton');
    Route::get('/laytonkhochitiet', [TonKhoController::class, 'getTonKhoChiTiet'])->name('lay.tonkhochitiet');
    Route::get('/laysoluongton/themhang', [TonKhoController::class, 'getSoLuongTonKhoThemHang'])->name('lay.slton.themhang');

    // Kiểm kho
    Route::get('/kiemkho', [PhieuKiemKhoController::class, 'getDanhSach'])->name('kiemkho');
    Route::get('/kiemkho/them', [PhieuKiemKhoController::class, 'getThem'])->name('kiemkho.them');
    Route::post('/kiemkho/them', [PhieuKiemKhoController::class, 'postThem'])->name('kiemkho.them');
    Route::get('/kiemkho/duyet/{id}', [PhieuKiemKhoController::class, 'getDuyet'])->name('kiemkho.duyet');
    Route::get('/kiemkho/boduyet/{id}', [PhieuKiemKhoController::class, 'getBoDuyet'])->name('kiemkho.boduyet');
    Route::get('/kiemkho/xemchitiet/{id}', [PhieuKiemKhoController::class, 'getXemChiTiet'])->name('kiemkho.xemchitiet');
    Route::get('/kiemkho/xoa/{id}', [PhieuKiemKhoController::class, 'getXoa'])->name('kiemkho.xoa');
    Route::get('/laysanphamkiemkho', [PhieuKiemKhoController::class, 'getSanPhamKiemKho'])->name('lay.spkt');
    Route::get('/laysanphamkiemkho/solo', [PhieuKiemKhoController::class, 'getSoLoSanPhamKiemKho'])->name('lay.slsp');
    Route::get('/laysanphamkiemkho/soluong', [PhieuKiemKhoController::class, 'getSoLuongSanPhamKiemKho'])->name('lay.soluongsl');

    // Thống kê
    Route::get('/thongke', [HomeController::class, 'getDanhSachThongKe'])->name('thongke');
    Route::get('/thongke/bieudo', [HomeController::class, 'getBieuDo'])->name('thongke.bieudo');

});



