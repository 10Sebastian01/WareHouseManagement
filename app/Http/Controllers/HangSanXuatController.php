<?php

namespace App\Http\Controllers;

use App\Models\HangSanXuat;
use Illuminate\Http\Request;


class HangSanXuatController extends Controller
{
    public function getDanhSach()
    {
        $hangsanxuat = HangSanXuat::all();
        return view('hangsanxuat.danhsach', compact('hangsanxuat'));
    }
    public function getThem()
    {
        return view('hangsanxuat.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'tenhangsanxuat' => ['required', 'string', 'max:191', 'unique:hangsanxuat'],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);
        $orm = new HangSanXuat();
        $orm->tenhangsanxuat = $request->tenhangsanxuat;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('hangsanxuat');
    }

    public function getSua($id)
    {
        $hangsanxuat = HangSanXuat::find($id);
        return view('hangsanxuat.sua', compact('hangsanxuat'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tenhangsanxuat' => ['required', 'string', 'max:191', 'unique:hangsanxuat,tenhangsanxuat,' .$id],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);
        $orm = HangSanXuat::find($id);
        $orm->tenhangsanxuat = $request->tenhangsanxuat;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('hangsanxuat');
    }

    public function getXoa($id)
    {
        $orm = HangSanXuat::find($id);
        $orm->delete();

        return redirect()->route('hangsanxuat');
    }
}
