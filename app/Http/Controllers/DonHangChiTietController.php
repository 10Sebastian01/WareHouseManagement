<?php

namespace App\Http\Controllers;

use App\Models\DonHangChiTiet;
use Illuminate\Http\Request;

class DonHangChiTietController extends Controller
{
    public function getDanhSach()
    {
        $donhangchitiet = DonHangChiTiet::all();
        return view('donhangchitiet.danhsach', compact('donhangchitiet'));
    }
    public function getThem()
    {
        return view('donhangchitiet.them');
    }

    public function postThem(Request $request)
    {
        $orm = new DonHangChiTiet();
        $orm->donhang_id= $request->donhang_id;
        $orm->sanpham_id= $request->sanpham_id;
        $orm->ngayhethan= $request->ngayhethan;
        $orm->losx_solo= $request->losx_solo;
        $orm->donvitinh_id= $request->donvitinh_id;
        $orm->soluong = $request->soluong;
        $orm->thanhtien = $request->thanhtien;
        $orm->save();

        return redirect()->route('donhangchitiet');
    }
    public function getSua($id)
    {
        $donhangchitiet = DonHangChiTiet::find($id);
        return view('donhangchitiet.sua', compact('donhangchitiet'));
    }

    public function postSua(Request $request, $id)
    {
        $orm = DonHangChiTiet::find($id);
        $orm->donhang_id= $request->donhang_id;
        $orm->sanpham_id= $request->sanpham_id;
        $orm->ngayhethan= $request->ngayhethan;
        $orm->losx_solo= $request->losx_solo;
        $orm->donvitinh_id= $request->donvitinh_id;
        $orm->soluong = $request->soluong;
        $orm->thanhtien = $request->thanhtien;
        $orm->save();

        return redirect()->route('donhangchitiet');
    }

    public function getXoa($id)
    {
        $orm = DonHangChiTiet::find($id);
        $orm->delete();

        return redirect()->route('donhangchitiet');
    }
}
