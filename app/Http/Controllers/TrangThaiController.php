<?php

namespace App\Http\Controllers;

use App\Models\TrangThai;
use Illuminate\Http\Request;

class TrangThaiController extends Controller
{
    public function getDanhSach()
    {
        $trangthai = TrangThai::all();
        return view('trangthai.danhsach', compact('trangthai'));
    }
    public function getThem()
    {
        return view('trangthai.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'ten' => ['required', 'string', 'max:191', 'unique:trangthai'],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);
        $orm = new TrangThai();
        $orm->ten = $request->ten;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('trangthai');
    }
    public function getSua($id)
    {
        $trangthai = TrangThai::find($id);
        return view('trangthai.sua', compact('trangthai'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'ten' => ['required', 'string', 'max:191', 'unique:trangthai,ten,' . $id],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);

        $orm = TrangThai::find($id);
        $orm->ten = $request->ten;
        $orm->ghichu = $request->ghichu;

        $orm->save();

        return redirect()->route('trangthai');
    }

    public function getXoa($id)
    {
        $orm = TrangThai::find($id);
        $orm->delete();

        return redirect()->route('trangthai');
    }
}
