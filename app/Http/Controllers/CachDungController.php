<?php

namespace App\Http\Controllers;

use App\Models\CachDung;
use Illuminate\Http\Request;

class CachDungController extends Controller
{
    public function getDanhSach()
    {
        $cachdung = CachDung::all();
        return view('cachdung.danhsach', compact('cachdung'));
    }
    public function getThem()
    {
        return view('cachdung.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'duongdung' => ['required', 'string', 'max:191', 'unique:cachdung'],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);

        $orm = new CachDung();
        $orm->duongdung = $request->duongdung;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('cachdung');
    }

    public function getSua($id)
    {
        $cachdung = CachDung::find($id);
        return view('cachdung.sua', compact('cachdung'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'duongdung' => ['required', 'string', 'max:191', 'unique:cachdung,duongdung,' . $id],
            'ghichu' => ['nullable', 'string', 'max:191']
        ]);

        $orm = CachDung::find($id);
        $orm->duongdung = $request->duongdung;
        $orm->ghichu = $request->ghichu;
        $orm->save();

        return redirect()->route('cachdung');
    }

    public function getXoa($id)
    {
        $orm = CachDung::find($id);
        $orm->delete();

        return redirect()->route('cachdung');
    }

}
