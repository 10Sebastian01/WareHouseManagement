<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\DonViTinh;
use App\Models\LoSanXuat;
use App\Models\NguoiDung;
use App\Models\PhieuKiemKho;
use App\Models\PhieuKiemKhoChiTiet;
use App\Models\SanPham;
use App\Models\TonKho;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PhieuKiemKhoController extends Controller
{
    public function getDanhSach()
    {
        $kiemkho = PhieuKiemKho::orderBy('created_at', 'desc')->paginate(7);
        return view('kiemkho.danhsach', compact('kiemkho'));
    }
    public function getThem()
    {
        $tonkho = TonKho::select('sanpham_id', DB::raw('SUM(soluong) as tongsoluong'))
            ->groupBy('sanpham_id')
            ->get();
        return view('kiemkho.them',compact('tonkho'));
    }

    public function postThem(Request $request)
    {
        $ghichu = $request->input('ghichu');
        $user = Auth::user();
        $ngayKiem = Carbon::now();

        $orm = new PhieuKiemKho();
        $orm->ngaykiem = $ngayKiem;
        $orm->nguoidung_id = $user->id;
        $orm->trangthai_id = 1;
        $orm->ghichu = $ghichu;
        $orm->save();
        // Lấy id
        $donHangId = $orm->id;

        $dssp = $request->input('danhSachSanPham');
        foreach ($dssp as $value)
        {
            $idsp = SanPham::where('tenthuoc', $value['tenSanPham'])->first();
            $losx = LoSanXuat::where('solo', $value['soLo'])->first();

            $phieuchitiet = new PhieuKiemKhoChiTiet();
            $phieuchitiet->phieukiemkho_id = $donHangId;
            $phieuchitiet->sanpham_id = $idsp->id;
            $phieuchitiet->losx_id = $losx->id;
            $phieuchitiet->donvitinh_id = $idsp->donvitinh_id;
            $phieuchitiet->ngayhethan = $losx->ngayhethan;
            $phieuchitiet->soluongtonkho =$value['slTon'];
            $phieuchitiet->soluongthucte =$value['slThucTe'];
            $phieuchitiet->chenhlech =$value['chenhLech'];

            $phieuchitiet->save();
        }
    }
    public function getSua($id)
    {
        $phieukiemkho = PhieuKiemKho::find($id);
        return view('phieukiemkho.sua', compact('phieukiemkho'));
    }

    public function postSua(Request $request, $id)
    {
        $orm = PhieuKiemKho::find($id);
        $orm->maphieukiem = $request->maphieukiem;
        $orm->nguoidung_id = $request->nguoidung_id;
        $orm->ngaykiem = $request->ngaykiem;
        $orm->trangthai_id = $request->trangthai_id;
        $orm->ghichu= $request->ghichu;
        $orm->save();

        return redirect()->route('phieukiemkho');
    }

    public function getXoa($id)
    {
        $orm = PhieuKiemKho::find($id);
        $orm->delete();

        return redirect()->route('phieukiemkho');
    }
    public function getSanPhamKiemKho(Request $request)
    {

        $idthuoc = $request->input('idthuoc');
        $thuocRecord = SanPham::where('id', $idthuoc)->first();

        $dvt = DonViTinh::where('id', $thuocRecord->donvitinh_id)->first();

        return response()->json(['donvitinh' => $dvt]);
    }
    public function getSoLoSanPhamKiemKho(Request $request)
    {
        $idthuoc = $request->input('idthuoc');

        $losxRecords = LoSanXuat::where('sanpham_id', $idthuoc)->get();

        $mangchuasolo = [];

        foreach ($losxRecords as $value)
        {
            $mangchuasolo[] = [
                'solo' => $value->solo,
                'soluong' => $value->soluong,
                'id' => $value->id
            ];
        }
        return response()->json(['mangsolo' => $mangchuasolo]);
    }
    public function getSoLuongSanPhamKiemKho(Request $request){
        $idlo = $request->input('idsolo');

        $soloRecord = LoSanXuat::where('id', $idlo)->first();

        return response()->json(['soluong' => $soloRecord->soluong,'ngayhh' => $soloRecord->ngayhethan]);
    }
    public function getDuyet($id)
    {
        $orm = PhieuKiemKho::find($id);
        $orm->trangthai_id = 1 + $orm->trangthai_id;
        $orm->save();
        return redirect()->route('kiemkho');
    }
    public function getBoDuyet($id)
    {
        $orm = PhieuKiemKho::find($id);
        $orm->trangthai_id = $orm->trangthai_id - 1;
        $orm->save();
        return redirect()->route('kiemkho');
    }
    public function getXemChiTiet($id){
        $phieukiem = PhieuKiemKho::find($id);
        $nguoidungRecord = NguoiDung::where('id', $phieukiem->nguoidung_id)->first();
        $tennguoikiem = $nguoidungRecord->name;

        // Chuyển đổi ngày tháng sang đối tượng Carbon
        $carbonDate = Carbon::parse($phieukiem->created_at);
        // Định dạng lại ngày tháng theo định dạng mong muốn
        $ngaykiem = $carbonDate->format('d/m/Y, H:i:s');


        $chitietdon = $phieukiem->PhieuKiemKhoChiTiet;
        $mangchitiet = [];

        foreach ($chitietdon as $value) //teen sanpham, số lô, dvt
        {
            $sanpham = SanPham::find($value->sanpham_id);
            $donvitinh = DonViTinh::find($value->donvitinh_id);
            $losanxuat = LoSanXuat::find($value->losx_id);

            // Cho vào mảng để gửi đi
            $mangchitiet[] = [
                'tensanpham' => $sanpham ? $sanpham->tenthuoc : null,
                'solo' => $losanxuat ? $losanxuat->solo : null,
                'tendonvitinh' => $donvitinh ? $donvitinh->dvt : null,
                'ngayhethan' => $value->ngayhethan,
                'soluonght' => $value->soluongtonkho,
                'soluongtt' => $value->soluongthucte,
                'chenhlech' => $value->chenhlech
            ];
        }
        return response()->json([
            'tennguoikiem' => $tennguoikiem,
            'maphieu' => $phieukiem->maphieukiem,
            'ngaytao' => $ngaykiem,
            'mangchitietDH' => $mangchitiet
        ]);
    }
}
