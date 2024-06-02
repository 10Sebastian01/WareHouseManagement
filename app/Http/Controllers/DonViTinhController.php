<?php

namespace App\Http\Controllers;

use App\Models\DonViTinh;
use Illuminate\Http\Request;

class DonViTinhController extends Controller
{
    public function getDanhSach()
    {
        $donvitinh = DonViTinh::all();
        return view('donvitinh.danhsach', compact('donvitinh'));
    }
    public function getThem()
    {
        return view('donvitinh.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'dvt' => ['required', 'string', 'max:191', 'unique:donvitinh'],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);
        $orm = new DonViTinh();
        $orm->dvt = $request->dvt;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('donvitinh');
    }

    public function getSua($id)
    {
        $donvitinh = DonViTinh::find($id);
        return view('donvitinh.sua', compact('donvitinh'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'dvt' => ['required', 'string', 'max:191', 'unique:donvitinh,dvt,' .$id],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);
        $orm = DonViTinh::find($id);
        $orm->dvt = $request->dvt;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('donvitinh');
    }

    public function getXoa($id)
    {
        $orm = DonViTinh::find($id);
        $orm->delete();

        return redirect()->route('donvitinh');
    }
}
