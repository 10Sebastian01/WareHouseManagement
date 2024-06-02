<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\DonHangChiTiet;
use App\Models\DonViTinh;
use App\Models\KhachHang;
use App\Models\NguoiDung;
use App\Models\TonKho;
use App\Models\NhaCungCap;
use App\Models\SanPham;
use App\Models\LoSanXuat;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class DonHangController extends Controller
{
    //Danh sách
    public function getDanhSachNhapkho()
    {
        $donnhap = DonHang::where('loaidonhang', 'nhaphang')
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        return view('nhapkho.danhsach', compact('donnhap'));
    }
    public function getDanhSachXuatkho()
    {
        $donxuat = DonHang::where('loaidonhang', 'xuathang')
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        return view('xuatkho.danhsach', compact('donxuat'));
    }

    // Thêm
    public function getThemNhapKho()
    {
        $ncc = NhaCungCap::all();

        $sp = SanPham::all();
        return view('nhapkho.them', compact('ncc', 'sp'));
    }
    public function getThemXuatKho()
    {
        $kh = KhachHang::all();
        $sp = SanPham::all();
        $tonkho = TonKho::select(
            'tonkho.sanpham_id',
            DB::raw('SUM(tonkho.soluong) as tongtonkho'))
            ->groupBy('sanpham_id')->get();
        return view('xuatkho.them', compact('kh', 'sp', 'tonkho'));
    }

    public function postThemNhapkho(Request $request)
    {
            $ncc = $request->input('nhacungcapId');
            $ghichu = $request->input('ghichu');

            $user = Auth::user();

            $orm = new DonHang();
            $orm->loaidonhang = 'nhaphang';
            $orm->nguoidung_id = $user->id;
            $orm->nhacungcap_id = $ncc;
            $orm->trangthai_id = 1;
            $orm->ghichu = $ghichu;
            $orm->save();
            // Lấy id đơn hàng vừa tạo
            $donHangId = $orm->id;

            $dssp = $request->input('danhSachSanPham');

            foreach ($dssp as $sanPham)
            {
                $validator = Validator::make($sanPham, [
                    'tenSanPham' => ['required', 'string'],
                    'soLo' => ['required', 'string'],
                    'donViTinh' => ['required', 'string'],
                    'ngayHetHan' => ['required', 'string'],
                    'soLuong' => ['required', 'string'],
                    'giaNhap' => ['required', 'string'],
                    'thanhTien' => ['required', 'string'],
                ]);
                // Lấy id của sản phẩm dựa vào tên
                $idsp = SanPham::where('tenthuoc', $sanPham['tenSanPham'])->first();

                // Đổi định dạng ngày hết hạn
                $ngayhh = $sanPham['ngayHetHan'];
                $date = DateTime::createFromFormat('m/d/Y', $ngayhh);
                $ngayhhdb = $date->format('Y-m-d');

                // Lấy đơn vị tính
                $dvt = DonViTinh::where('dvt', $sanPham['donViTinh'])->first();

                //Lưu vào bảng losx
                $losx = LoSanXuat::where('solo', $sanPham['soLo'])->first();
                if ($losx) {
                    // Số lô đã tồn tại, cập nhật số lượng
                    $losx->soluong += $sanPham['soLuong'];
                    $losx->save();
                } else {
                    // Tạo mới số lô
                    $losx = new LoSanXuat();
                    $losx->solo = $sanPham['soLo'];
                    $losx->sanpham_id = $idsp->id;
                    $losx->soluong = $sanPham['soLuong'];
                    $losx->ngayhethan = $ngayhhdb;
                    $losx->save();
                }

                // Lưu vào đơn hàng chi tiết
                $donHangChiTiet = new DonHangChiTiet();
                $donHangChiTiet->ngayhethan = $ngayhhdb;
                $donHangChiTiet->donhang_id = $donHangId;
                $donHangChiTiet->losx_id = $losx->id;
                $donHangChiTiet->donvitinh_id = $dvt->id;
                $donHangChiTiet->sanpham_id = $idsp->id;
                $donHangChiTiet->soluong = $sanPham['soLuong'];
                $donHangChiTiet->thanhtien = $sanPham['thanhTien'];

                $donHangChiTiet->save();

                // Lưu vào tồn kho
                $tonkho = new TonKho();
                $tonkho->losx_id = $losx->id;
                $tonkho->soluong = $sanPham['soLuong'];
                $tonkho->sanpham_id = $idsp->id;
                $tonkho->donhang_id = $donHangId;
                $tonkho->ngayhethan = $ngayhhdb;

                $tonkho->save();
            }
    }
    public function getXemChiTietNhapKho($id)
    {
        $donHang = DonHang::find($id);
        $banghincc = NhaCungCap::where('id', $donHang->nhacungcap_id)->first();
        $tenncc = $banghincc->tennhacungcap;
        $nguoinhap = NguoiDung::find($donHang->nguoidung_id);
        $ghichu = $donHang->ghichu;

        // Chuyển đổi ngày tháng sang đối tượng Carbon
        $carbonDate = Carbon::parse($donHang->created_at);

        $ngaynhap = $carbonDate->format('d/m/Y, H:i:s');


        $chitietdon = $donHang->DonHangChiTiet;
        $mangchitiet = [];
        $tongtien = 0;
        foreach ($chitietdon as $value) //teen sanpham, số lô, dvt
        {
            $sanpham = SanPham::find($value->sanpham_id);
            $donvitinh = DonViTinh::find($value->donvitinh_id);
            $losanxuat = LoSanXuat::find($value->losx_id);

            // Cho vào mảng để gửi đi
            $mangchitiet[] = [
                'tensanpham' => $sanpham ? $sanpham->tenthuoc : null,
                'solo' => $losanxuat ? $losanxuat->solo : null,
                'tendonvitinh' => $donvitinh ? $donvitinh->dvt : null,
                'ngayhethan' => $value->ngayhethan,
                'soluong' => $value->soluong,
                'thanhtien' => $value->thanhtien
            ];
            $tongtien += $value['thanhtien'];
        }
        return response()->json([
            'id' => $donHang->madon,
            'tenncc' => $tenncc,
            'nguoinhap' => $nguoinhap->name,
            'tongtien' => $tongtien,
            'ngaytao' => $ngaynhap,
            'ghichu' => $ghichu,
            'mangchitietDH' => $mangchitiet
            ]);
    }
    public function postThemXuatkho(Request $request)
    {
        try {
            $kh = $request->input('khachhang');
            $ghichu = $request->input('ghichu');

            $user = Auth::user();

            $orm = new DonHang();
            $orm->loaidonhang = 'xuathang';
            $orm->nguoidung_id = $user->id;
            $orm->khachhang_id = $kh;
            $orm->trangthai_id = 1;
            $orm->ghichu = $ghichu;
            $orm->save();
            // Lấy id đơn hàng vừa tạo
            $donHangId = $orm->id;

            $dssp = $request->input('danhSachSanPham');


            foreach ($dssp as $sanPham)
            {
                $validator = Validator::make($sanPham, [
                    'tenSanPham' => ['required', 'string'],
                    'donViTinh' => ['required', 'string'],
                    'soLuong' => ['required', 'string'],
                    'giaNhap' => ['required', 'string'],
                    'thanhTien' => ['required', 'string'],
                ]);
                $soluongcanxuat = $sanPham['soLuong'];

                // Lấy id của sản phẩm dựa vào tên
                $idsp = SanPham::where('tenthuoc', $sanPham['tenSanPham'])->first();

                //***-------------------------------------------------- xử lý cho bảng tonkho
                $oldestBatch = TonKho::where('sanpham_id', $idsp->id)
                    ->orderBy('ngayhethan', 'asc')
                    ->get();

                $soluongdaxuat = 0;

                foreach ($oldestBatch as $value) {
                    if ($soluongdaxuat < $soluongcanxuat) {
                        $soluongtruduoc = min($value->soluong, $soluongcanxuat - $soluongdaxuat);
                        $soluongdaxuat += $soluongtruduoc;

                        // so lượng sau khi trừ lớn hơn 0 thì mới thêm vào bảng donhangchitiet
                        if ($soluongtruduoc > 0) {
                            $donhangchitiet = new DonHangChiTiet();
                            $donhangchitiet->donhang_id = $donHangId;
                            $donhangchitiet->sanpham_id = $value->sanpham_id;
                            $donhangchitiet->losx_id = $value->losx_id;

                            // số lượng từ số lo
                            $soluongloRecords = LoSanXuat::where('id', $value->losx_id)->first();
                            $donhangchitiet->ngayhethan = $soluongloRecords->ngayhethan;

                            // dvt
                            $laydvt = SanPham::find($value->sanpham_id);
                            $dvt = DonViTinh::where('id', $laydvt->donvitinh_id)->first();
                            $donhangchitiet->donvitinh_id = $dvt->id;

                            // soluong và thanhtien
                            $donhangchitiet->soluong = $soluongtruduoc;
                            $sanpham = SanPham::find($value->sanpham_id);
                            $donhangchitiet->thanhtien = $sanpham->giaxuat * $soluongtruduoc;

                            $donhangchitiet->save();

                            // Cập nhật số lượng bảng tonkho
                            $value->soluong -= $soluongtruduoc;
                            $value->save();

                            // Cập nhật số lượng bảng losx
                            $soluongloRecords->soluong -= $soluongtruduoc;
                            $soluongloRecords->save();
                        }
                    } else {
                        break;
                    }
                }

            }
        }catch (Exception $e){
            Log::error('Error fetching unit: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching unit'], 500);
        }
    }

    // Sửa
    public function getDuyetNhapkho($id)
    {
        $orm = DonHang::find($id);
        $orm->trangthai_id = 1 + $orm->trangthai_id;
        $orm->save();
        return redirect()->route('nhapkho');
    }
    public function getBoDuyetNhapkho($id)
    {
        $orm = DonHang::find($id);
        $orm->trangthai_id = $orm->trangthai_id - 1;
        $orm->save();
        return redirect()->route('nhapkho');
    }
    public function getDuyetXuatkho($id)
    {
        $orm = DonHang::find($id);
        $orm->trangthai_id = 1 + $orm->trangthai_id;
        $orm->save();
        return redirect()->route('xuatkho');
    }
    public function getBoDuyetXuatkho($id)
    {
        $orm = DonHang::find($id);
        $orm->trangthai_id = $orm->trangthai_id - 1;
        $orm->save();
        return redirect()->route('xuatkho');
    }

    // Xóa
    public function getXoaNhapkho($id)
    {
        $orm = DonHang::find($id);
        $orm->delete();

        return redirect()->route('nhapkho');
    }
    public function getXoaXuatkho($id)
    {
        $orm = DonHang::find($id);
        $orm->delete();

        return redirect()->route('xuatkho');
    }
    public function getXemChiTietXuatKho($id)
    {
        $donHang = DonHang::find($id);
        $banghikh = KhachHang::where('id', $donHang->khachhang_id)->first();
        $tenkh = $banghikh->tenkh;
        $nguoixuat = NguoiDung::find($donHang->nguoidung_id);
        $ghichu = $donHang->ghichu;
        // Chuyển đổi ngày tháng sang đối tượng Carbon
        $carbonDate = Carbon::parse($donHang->created_at);

        // Định dạng lại ngày tháng theo định dạng mong muốn
        $ngayxuat = $carbonDate->format('d/m/Y, H:i:s');


        $chitietdon = $donHang->DonHangChiTiet;
        $mangchitiet = [];
        $tongtien = 0;
        foreach ($chitietdon as $value) //teen sanpham, số lô, dvt
        {
            $sanpham = SanPham::find($value->sanpham_id);
            $donvitinh = DonViTinh::find($value->donvitinh_id);
            $losanxuat = LoSanXuat::find($value->losx_id);

            // Cho vào mảng để gửi đi
            $mangchitiet[] = [
                'tensanpham' => $sanpham ? $sanpham->tenthuoc : null,
                'solo' => $losanxuat ? $losanxuat->solo : null,
                'tendonvitinh' => $donvitinh ? $donvitinh->dvt : null,
                'ngayhethan' => $value->ngayhethan,
                'soluong' => $value->soluong,
                'thanhtien' => $value->thanhtien,
            ];
            $tongtien += $value['thanhtien'];
        }
        return response()->json([
            'tenkh' => $tenkh,
            'id' => $donHang->madon,
            'ghichu' => $ghichu,
            'nguoixuat' => $nguoixuat->name,
            'tongtien' => $tongtien,
            'ngaytao' => $ngayxuat,
            'mangchitietDH' => $mangchitiet
        ]);
    }
}
