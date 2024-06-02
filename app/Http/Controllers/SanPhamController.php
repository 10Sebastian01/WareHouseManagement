<?php

namespace App\Http\Controllers;

use App\Models\CachDung;
use App\Models\DanhMucSanPham;
use App\Models\DonViTinh;
use App\Models\HangSanXuat;
use App\Models\NhaCungCap;
use App\Models\NhomThuoc;
use App\Models\PhanLoaiDuoc;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Imports\SanPhamImport;
use App\Exports\SanPhamExport;
use Maatwebsite\Excel\Facades\Excel as ExcelAlias;


class SanPhamController extends Controller
{
    public function getDanhSach()
    {
        $sanpham = SanPham::all();
        return view('sanpham.danhsach', compact('sanpham'));
    }
    public function getThem()
    {
        $dmsp = DanhMucSanPham::all();
        $nhomthuoc = NhomThuoc::all();
        $phanloaiduoc = PhanLoaiDuoc::all();
        $dvt = DonViTinh::all();
        $cachdung = CachDung::all();
        $hsx = HangSanXuat::all();
        $ncc = NhaCungCap::all();
        return view('sanpham.them', compact('dmsp', 'nhomthuoc', 'phanloaiduoc', 'dvt', 'cachdung', 'hsx', 'ncc'));
    }

    public function postThem(Request $request)
    {
//        Kiểm tra dữ liệu trước
        $request->validate([
            'tenthuoc' => ['required', 'string', 'max:191', 'unique:sanpham'],
            'danhmucsanpham_id' => ['required'],
            'nhomthuoc_id' => ['required'],
            'phanloaiduoc_id' => ['required'],
            'hoatchat' => ['nullable', 'string', 'max:191'],
            'donvitinh_id' => ['required'],
            'cachdung_id' => ['required'],

            'kedon' => ['required', 'string', 'in:co,khong'],

            'hangsanxuat_id' => ['required'],
            'nhacungcap_id' => ['required'],
            'quocgia' => ['nullable', 'string', 'max:191'],
            'nguonnhap' => ['required', 'string', 'in:bh,tp'],
            'gianhap' => ['required', 'numeric'],
            'giaxuat' => ['required', 'numeric']
        ]);

//        Xử lý khi dữ liệu đã hơp lệ
        $orm = new SanPham();
        $orm->tenthuoc = $request->tenthuoc;
        $orm->danhmucsanpham_id= $request->danhmucsanpham_id;
        $orm->nhomthuoc_id= $request->nhomthuoc_id;
        $orm->phanloaiduoc_id= $request->phanloaiduoc_id;
        $orm->hoatchat= $request->hoatchat;
        $orm->donvitinh_id= $request->donvitinh_id;
        $orm->cachdung_id= $request->cachdung_id;

        $orm->kedon = $request->kedon;

        $orm->hangsanxuat_id = $request->hangsanxuat_id;
        $orm->nhacungcap_id = $request->nhacungcap_id;
        $orm->quocgia = $request->quocgia;
        $orm->nguonnhap = $request->nguonnhap;
        $orm->gianhap = $request->gianhap;
        $orm->giaxuat = $request->giaxuat;
        $orm->save();

        return redirect()->route('sanpham');
    }
    public function getSua($id)
    {
        $sanpham = SanPham::find($id);
        $nhomthuoc = NhomThuoc::all();
        $phanloaiduoc = PhanLoaiDuoc::all();
        $hangsanxuat = HangSanXuat::all();
        $nhacungcap = NhaCungCap::all();
        $dvt = DonViTinh::all();
        $dmsp = DanhMucSanPham::all();
        $cachdung = CachDung::all();
        return view('sanpham.sua', compact('sanpham', 'nhomthuoc', 'hangsanxuat', 'dvt', 'dmsp', 'phanloaiduoc', 'nhacungcap', 'cachdung'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tenthuoc' => ['required', 'string', 'max:191', 'unique:sanpham,tenthuoc,' . $id],
            'danhmucsanpham_id' => ['required'],
            'nhomthuoc_id' => ['required'],
            'phanloaiduoc_id' => ['required'],
            'hoatchat' => ['nullable', 'string', 'max:191'],
            'donvitinh_id' => ['required'],
            'cachdung_id' => ['required'],

            'kedon' => ['required', 'string', 'in:co,khong'],

            'hangsanxuat_id' => ['required'],
            'nhacungcap_id' => ['required'],
            'quocgia' => ['nullable', 'string', 'max:191'],
            'nguonnhap' => ['required', 'string', 'in:bh,tp'],
            'gianhap' => ['required', 'numeric'],
            'giaxuat' => ['required', 'numeric']
        ]);

        $orm = SanPham::find($id);
        $orm->tenthuoc = $request->tenthuoc;
        $orm->danhmucsanpham_id= $request->danhmucsanpham_id;
        $orm->nhomthuoc_id= $request->nhomthuoc_id;
        $orm->phanloaiduoc_id= $request->phanloaiduoc_id;
        $orm->hoatchat= $request->hoatchat;
        $orm->donvitinh_id= $request->donvitinh_id;
        $orm->cachdung_id= $request->cachdung_id;

        $orm->kedon = $request->kedon;

        $orm->hangsanxuat_id = $request->hangsanxuat_id;
        $orm->nhacungcap_id = $request->nhacungcap_id;
        $orm->quocgia = $request->quocgia;
        $orm->nguonnhap = $request->nguonnhap;
        $orm->gianhap = $request->gianhap;
        $orm->giaxuat = $request->giaxuat;
        $orm->save();

        return redirect()->route('sanpham');
    }

    public function getXoa($id)
    {
        $orm = SanPham::find($id);
        $orm->delete();

        return redirect()->route('sanpham');
    }
    public function postNhap(Request $request)
    {
        ExcelAlias::import(new SanPhamImport, $request->file('exampleInputFile'));
        return redirect()->route('sanpham');
    }
    public function getXuat()
    {
        return ExcelAlias::download(new SanPhamExport, 'danh-sach-san-pham.xlsx') ;
    }

    public function getDonViTinh(Request $request)
    {
        try {
            // Lấy value là giá trị cột id của bảng sanpham gán vào biến tenthuoc, biến này được truyền đến hàm này
            $tenthuoc = $request->input('tenthuoc');
            //Truy vấn SQL lấy giá trị của cột donvitinh_id trong bảng sanpham gán vào biến $dvt
            $dvt = SanPham::where('id', $tenthuoc)->value('donvitinh_id');
            // Truy vấn đến bảng donvitinh để lấy tên đơn vị tính
            $donvitinh = DonViTinh::where('id', $dvt)->value('dvt');

            // Lấy giá nhập của sản phẩm
            $gianhap = SanPham::where('id', $tenthuoc)->value('gianhap');

            return response()->json(['donvitinh_id' => $donvitinh, 'gianhap' => $gianhap]);
        }catch (Exception $e){
            Log::error('Error fetching unit: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching unit'], 500);
        }
    }


}
