<?php

namespace App\Http\Controllers;

use App\Models\CachDung;
use App\Models\DanhMucSanPham;
use Illuminate\Http\Request;

class DanhMucSanPhamController extends Controller
{
    public function getDanhSach()
    {
        $danhmucsanpham  = DanhMucSanPham::all();
        return view('danhmucsanpham.danhsach', compact('danhmucsanpham'));
    }
    public function getThem()
    {
        return view('danhmucsanpham.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'tendanhmuc' => ['required', 'string', 'max:191', 'unique:danhmucsanpham'],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);
        $orm = new DanhMucSanPham();
        $orm->tendanhmuc = $request->tendanhmuc;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('danhmuc');
    }

    public function getSua($id)
    {
        $danhmucsanpham = DanhMucSanPham::find($id);
        return view('danhmucsanpham.sua', compact('danhmucsanpham'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tendanhmuc' => ['required', 'string', 'max:191', 'unique:danhmucsanpham,tendanhmuc,' . $id],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);
        $orm = DanhMucSanPham::find($id);
        $orm->tendanhmuc = $request->tendanhmuc;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('danhmuc');
    }

    public function getXoa($id)
    {
        $orm = DanhMucSanPham::find($id);
        $orm->delete();

        return redirect()->route('danhmuc');
    }
}
