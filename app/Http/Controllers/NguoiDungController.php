<?php
namespace App\Http\Controllers;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class NguoiDungController extends Controller
{
    public function getDanhSach()
    {
        $nguoidung = NguoiDung::all();
        return view('nguoidung.danhsach', compact('nguoidung'));
    }

    public function getThem()
    {
        return view('nguoidung.them');
    }

    public function postThem(Request $request)
    {
        // Kiểm tra
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:nguoidung'],

            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        $orm = new NguoiDung();
        $orm->name = $request->name;
        $orm->email = $request->email;
        $orm->password = Hash::make($request->password);
        $orm->isAdmin = 0;
        $orm->save();

        // Sau khi thêm thành công thì tự động chuyển về trang danh sách
        return redirect()->route('nguoidung');
    }

    public function getSua($id)
    {
        $nguoidung = NguoiDung::find($id);
        return view('nguoidung.sua', compact('nguoidung'));
    }

    public function postSua(Request $request, $id)
    {
        // Kiểm tra
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:nguoidung,email,' . $id],
            'password' => ['confirmed'],
        ]);

        $orm = NguoiDung::find($request->id);
        $orm->name = $request->name;
        $orm->email = $request->email;
        if(!empty($request->password)) $orm->password = Hash::make($request->password);
        $orm->save();

        // Sau khi sửa thành công thì tự động chuyển về trang danh sách
        return redirect()->route('nguoidung');
    }

    public function getXoa($id)
    {
        $orm = NguoiDung::find($id);
        $orm->delete();

        // Sau khi xóa thành công thì tự động chuyển về trang danh sách
        return redirect()->route('nguoidung');
    }
    public function getDoiVaiTro($id)
    {

        $orm = NguoiDung::find($id);
        $orm->isAdmin = 1 - $orm->isAdmin;
        $orm->save();
        return redirect()->route('nguoidung');
    }
}
