<?php

namespace App\Http\Controllers;

use App\Models\PhieuKiemKhoChiTiet;
use Illuminate\Http\Request;

class PhieuKiemKhoChiTietController extends Controller
{
    public function getDanhSach()
    {
        $phieukiemkhochitiet = PhieuKiemKhoChiTiet::all();
        return view('phieukiemkhochitiet.danhsach', compact('phieukiemkhochitiet'));
    }
    public function getThem()
    {
        return view('phieukiemkhochitiet.them');
    }

    public function postThem(Request $request)
    {
        $orm = new PhieuKiemKhoChiTiet();
        $orm->phieukiemkho_id = $request->phieukiemkho_id;
        $orm->sanpham_id = $request->sanpham_id;
        $orm->losx_id = $request->losx_id;
        $orm->ngayhethan = $request->ngayhethan;
        $orm->soluongtonkho = $request->soluongtonkho;
        $orm->soluongthucte = $request->soluongthucte;
        $orm->save();

        return redirect()->route('phieukiemkhochitiet');
    }
    public function getSua($id)
    {
        $phieukiemkhochitiet = PhieuKiemKhoChiTiet::find($id);
        return view('phieukiemkhochitiet.sua', compact('phieukiemkhochitiet'));
    }

    public function postSua(Request $request, $id)
    {
        $orm = PhieuKiemKhoChiTiet::find($id);
        $orm->tenloai = $request->tenloai;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('phieukiemkhochitiet');
    }

    public function getXoa($id)
    {
        $orm = PhieuKiemKhoChiTiet::find($id);
        $orm->delete();

        return redirect()->route('phieukiemkhochitiet');
    }
}
