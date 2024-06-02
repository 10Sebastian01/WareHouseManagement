<?php

namespace App\Http\Controllers;

use App\Models\LoSanXuat;
use Illuminate\Http\Request;

class LoSanXuatController extends Controller
{
    public function getDanhSach()
    {
        $losanxuat = LoSanXuat::all();
        return view('losanxuat.danhsach', compact('losanxuat'));
    }
    public function getThem()
    {
        return view('losanxuat.them');
    }

    public function postThem(Request $request)
    {
        $orm = new LoSanXuat();
        $orm->solo = $request->solo;
        $orm->sanpham_id = $request->sanpham_id;
        $orm->soluong = $request->soluong;
        $orm->ngayhethan = $request->ngayhethan;
        $orm->save();

        return redirect()->route('losanxuat');
    }
    public function getSua($id)
    {
        $losanxuat = LoSanXuat::find($id);
        return view('losanxuat.sua', compact('losanxuat'));
    }

    public function postSua(Request $request, $id)
    {
        $orm = LoSanXuat::find($id);
        $orm->solo = $request->solo;
        $orm->sanpham_id = $request->sanpham_id;
        $orm->soluong = $request->soluong;
        $orm->ngayhethan = $request->ngayhethan;
        $orm->save();

        return redirect()->route('losanxuat');
    }

    public function getXoa($id)
    {
        $orm = LoSanXuat::find($id);
        $orm->delete();

        return redirect()->route('losanxuat');
    }
}
