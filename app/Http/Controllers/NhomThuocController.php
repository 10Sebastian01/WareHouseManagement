<?php

namespace App\Http\Controllers;

use App\Models\NhomThuoc;
use Illuminate\Http\Request;

class NhomThuocController extends Controller
{
    public function getDanhSach()
    {
        $nhomthuoc = NhomThuoc::all();
        return view('nhomthuoc.danhsach', compact('nhomthuoc'));
    }
    public function getThem()
    {
        return view('nhomthuoc.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'tennhomthuoc' => ['required', 'string', 'max:191', 'unique:nhomthuoc'],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);
        $orm = new NhomThuoc();
        $orm->tennhomthuoc = $request->tennhomthuoc;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('nhomthuoc');
    }
    public function getSua($id)
    {
        $nhomthuoc = NhomThuoc::find($id);
        return view('nhomthuoc.sua', compact('nhomthuoc'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tennhomthuoc' => ['required', 'string', 'max:191', 'unique:nhomthuoc,tennhomthuoc,' .$id],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);
        $orm = NhomThuoc::find($id);
        $orm->tennhomthuoc = $request->tennhomthuoc;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('nhomthuoc');
    }

    public function getXoa($id)
    {
        $orm = NhomThuoc::find($id);
        $orm->delete();

        return redirect()->route('nhomthuoc');
    }
}
