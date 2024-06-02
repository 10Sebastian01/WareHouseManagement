<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;

class KhachHangController extends Controller
{
    public function getDanhSach()
    {
        $khachhang = KhachHang::all();
        return view('khachhang.danhsach', compact('khachhang'));
    }
    public function getThem()
    {
        return view('khachhang.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'tenkh' => ['required', 'string', 'max:191', 'unique:khachhang'],
            'sodienthoai' => ['nullable', 'numeric', 'digits_between:10,11'],
            'diachi' => ['nullable', 'string', 'max:191']
        ]);

        $orm = new KhachHang();
        $orm->tenkh = $request->tenkh;
        $orm->sodienthoai = $request->sodienthoai;
        $orm->diachi = $request->diachi;
        $orm->save();

        return redirect()->route('khachhang');
    }
    public function getSua($id)
    {
        $khachhang = KhachHang::find($id);
        return view('khachhang.sua', compact('khachhang'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tenkh' => ['required', 'string', 'max:191', 'unique:khachhang,tenkh,' . $id],
            'sodienthoai' => ['nullable', 'numeric', 'digits_between:10,11'],
            'diachi' => ['nullable', 'string', 'max:191']
        ]);
        $orm = KhachHang::find($id);
        $orm->tenkh = $request->tenkh;
        $orm->sodienthoai = $request->sodienthoai;
        $orm->diachi = $request->diachi;
        $orm->save();

        return redirect()->route('khachhang');
    }

    public function getXoa($id)
    {
        $orm = KhachHang::find($id);
        $orm->delete();

        return redirect()->route('khachhang');
    }
    public function getKhachHang(Request $request){

        $kh = $request->input('tenkh');
        $ttkh = KhachHang::where('id', $kh)->first();

        return response()->json([
            'sdt' => $ttkh->sodienthoai,
            'diachi' => $ttkh->diachi
            ]);
    }
}
