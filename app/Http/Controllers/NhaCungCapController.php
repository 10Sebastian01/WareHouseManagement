<?php

namespace App\Http\Controllers;

use App\Models\NhaCungCap;
use Illuminate\Http\Request;

class NhaCungCapController extends Controller
{
    public function getDanhSach()
    {
        $nhacungcap = NhaCungCap::all();
        return view('nhacungcap.danhsach', compact('nhacungcap'));
    }
    public function getThem()
    {
        return view('nhacungcap.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'tennhacungcap' => ['required', 'string', 'max:191', 'unique:nhacungcap'],
            'tenviettat' => ['nullable', 'string', 'max:191'],
            'masothue' => ['required', 'numeric'],
            'sodienthoai' => ['nullable', 'numeric', 'digits_between:10,11'],
            'diachi' => ['nullable', 'string', 'max:191']
        ]);
        $orm = new NhaCungCap();
        $orm->tennhacungcap = $request->tennhacungcap;
        $orm->tenviettat = $request->tenviettat;
        $orm->masothue = $request->masothue;
        $orm->sodienthoai = $request->sodienthoai;
        $orm->diachi = $request->diachi;
        $orm->save();

        return redirect()->route('nhacungcap');
    }
    public function getSua($id)
    {
        $nhacungcap = NhaCungCap::find($id);
        return view('nhacungcap.sua', compact('nhacungcap'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tennhacungcap' => ['required', 'string', 'max:191', 'unique:nhacungcap,tennhacungcap,' .$id],
            'tenviettat' => ['nullable', 'string', 'max:191'],
            'masothue' => ['required', 'numeric'],
            'sodienthoai' => ['nullable', 'numeric', 'digits_between:10,11'],
            'diachi' => ['nullable', 'string', 'max:191']
        ]);
        $orm = NhaCungCap::find($id);
        $orm->tennhacungcap = $request->tennhacungcap;
        $orm->tenviettat = $request->tenviettat;
        $orm->masothue = $request->masothue;
        $orm->sodienthoai = $request->sodienthoai;
        $orm->diachi = $request->diachi;
        $orm->save();

        return redirect()->route('nhacungcap');
    }

    public function getXoa($id)
    {
        $orm = NhaCungCap::find($id);
        $orm->delete();

        return redirect()->route('nhacungcap');
    }
}
