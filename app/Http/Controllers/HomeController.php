<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\DonViTinh;
use App\Models\KhachHang;
use App\Models\LoSanXuat;
use App\Models\NguoiDung;
use App\Models\NhaCungCap;
use App\Models\SanPham;
use App\Models\TonKho;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $ngayDauThang;
    protected $ngayCuoiThang;
    protected $ngayHienTai;

    public function __construct()
    {
        $this->ngayDauThang = Carbon::now()->startOfMonth();
        $this->ngayCuoiThang = Carbon::now()->endOfMonth();
        $this->ngayHienTai = Carbon::now()->toDateString();
    }
    public function getHome()
    {
        return view('home');
    }
    public function getDanhSachThongKe(){
        $tongslton = TonKho::sum('soluong'); // Tổng tồn

        $tongGiaTri = DB::table('tonkho')
            ->join('sanpham', 'tonkho.sanpham_id', '=', 'sanpham.id')
            ->sum(DB::raw('sanpham.gianhap * tonkho.soluong'));

        $tongSoLuongXuat = DB::table('donhang')
            ->where('loaidonhang', 'xuathang')
            ->join('donhangchitiet', 'donhang_id', '=', 'donhang.id')
            ->sum('donhangchitiet.soluong');

        $soDonHangMoi = DB::table('donhang')
            ->whereDate('created_at', $this->ngayHienTai)
            ->count();

        $tongsldon = DonHang::whereBetween('created_at', [$this->ngayDauThang, $this->ngayCuoiThang])->count();

        $tongsp = SanPham::count();

        $tongnhansu = NguoiDung::where('isAdmin', 0)->count();

        $tongkh = KhachHang::count();

        $tongncc = NhaCungCap::count();

        return view('thongke.danhsach', compact(
            'tongnhansu', 'tongsp', 'tongGiaTri',
            'tongsldon', 'tongslton','tongSoLuongXuat','soDonHangMoi',
            'tongkh', 'tongncc'));
    }
    public function getBieuDo(){
        // Lấy ngày đầu tiên và ngày cuối cùng của tháng hiện tại


        // Lấy dữ liệu thống kê đơn nhập và xuất theo ngày của tháng hiện tại
        $dataNhap = DonHang::where('loaidonhang', 'nhaphang')
            ->whereBetween('created_at', [$this->ngayDauThang, $this->ngayCuoiThang])
            ->selectRaw('DAY(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->get();

        $dataXuat = DonHang::where('loaidonhang', 'xuathang')
            ->whereBetween('created_at', [$this->ngayDauThang, $this->ngayCuoiThang])
            ->selectRaw('DAY(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->get();

        // Trả về dữ liệu dưới dạng JSON
        return response()->json([
            'dataNhap' => $dataNhap,
            'dataXuat' => $dataXuat,
        ]);
    }
}
