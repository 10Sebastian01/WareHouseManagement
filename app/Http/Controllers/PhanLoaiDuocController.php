<?php

namespace App\Http\Controllers;

use App\Models\PhanLoaiDuoc;
use Illuminate\Http\Request;

class PhanLoaiDuocController extends Controller
{
    public function getDanhSach()
    {
        $phanloaiduoc = PhanLoaiDuoc::all();
        return view('phanloaiduoc.danhsach', compact('phanloaiduoc'));
    }
    public function getThem()
    {
        return view('phanloaiduoc.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'tenloai' => ['required', 'string', 'max:191', 'unique:phanloaiduoc'],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);
        $orm = new PhanLoaiDuoc();
        $orm->tenloai = $request->tenloai;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('phanloaiduoc');
    }
    public function getSua($id)
    {
        $phanloaiduoc = PhanLoaiDuoc::find($id);
        return view('phanloaiduoc.sua', compact('phanloaiduoc'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tenloai' => ['required', 'string', 'max:191', 'unique:phanloaiduoc,tenloai,' .$id],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);
        $orm = PhanLoaiDuoc::find($id);
        $orm->tenloai = $request->tenloai;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('phanloaiduoc');
    }

    public function getXoa($id)
    {
        $orm = PhanLoaiDuoc::find($id);
        $orm->delete();

        return redirect()->route('phanloaiduoc');
    }
}
