<?php

namespace App\Http\Controllers;

use App\Models\DonViTinh;
use App\Models\DanhMucSanPham;
use App\Models\LoSanXuat;
use App\Models\SanPham;
use App\Models\TonKho;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TonKhoController extends Controller
{
    public function getDanhSach()
    {

        // Lấy bản ghi theo nhóm sanpham_id và tổng số lượng của từng nhóm
        $groupedData = TonKho::select(
            'tonkho.sanpham_id',
            DB::raw('SUM(tonkho.soluong) as tongtonkho'),
            'tendanhmuc',
            'dvt'
        )
            ->join('sanpham', 'tonkho.sanpham_id', '=', 'sanpham.id')
            ->join('danhmucsanpham', 'sanpham.danhmucsanpham_id', '=', 'danhmucsanpham.id')
            ->join('donvitinh', 'sanpham.donvitinh_id', '=', 'donvitinh.id')
            ->groupBy('tonkho.sanpham_id')
            ->orderBy('tongtonkho', 'asc')
            ->paginate(7);
        $tongton = TonKho::sum('soluong');

        return view('tonkho.danhsach', compact(
            'groupedData', 'tongton'
            ));
    }
    public function getThem()
    {
        return view('tonkho.them');
    }

    public function postThem(Request $request)
    {
        $orm = new TonKho();
        $orm->losx_id = $request->losx_id;
        $orm->soluong = $request->soluong;
        $orm->sanpham_id = $request->sanpham_id;
        $orm->donhang_id = $request->donhang_id;
        $orm->ngayhethan = $request->ngayhethan;
        $orm->save();

        return redirect()->route('tonkho');
    }
    public function getSua($id)
    {
        $tonkho = TonKho::find($id);
        return view('tonkho.sua', compact('tonkho'));
    }

    public function postSua(Request $request, $id)
    {
        $orm = TonKho::find($id);
        $orm->losx_id = $request->losx_id;
        $orm->soluong = $request->soluong;
        $orm->sanpham_id = $request->sanpham_id;
        $orm->donhang_id = $request->donhang_id;
        $orm->ngayhethan = $request->ngayhethan;
        $orm->save();

        return redirect()->route('tonkho');
    }

    public function getXoa($id)
    {
        $orm = TonKho::find($id);
        $orm->delete();

        return redirect()->route('tonkho');
    }
    public function getSoLuongTonKho(Request $request){
        $idthuoc = $request->input('idthuoc');

        //Truy vấn SQL lấy giá trị của cột donvitinh_id trong bảng sanpham gán vào biến $dvt
        $dvt = SanPham::where('id', $idthuoc)->value('donvitinh_id');
        // Truy vấn đến bảng donvitinh để lấy tên đơn vị tính
        $donvitinh = DonViTinh::where('id', $dvt)->value('dvt');

        // Lấy giá nhập của sản phẩm
        $giaxuat = SanPham::where('id', $idthuoc)->value('giaxuat');

        $record = TonKho::where('sanpham_id', $idthuoc)->get();

        return response()->json([
            'slt' => $record->sum('soluong'),
            'dvt' => $donvitinh,
            'giaxuat' => $giaxuat]);
    }
    public function getSoLuongTonKhoThemHang(Request $request){
        $idsp = $request->input('idthuoc');
        $sldachon = $request->input('sl');
        $recordTon = TonKho::where('sanpham_id', $idsp)->get();
        $sltonkho = $recordTon->sum('soluong');

        if($sldachon <= $sltonkho)
        {
         return response()->json(['success' => true]);
        }else
        {
            return response()->json(['error' => true]);
        }
    }
    public function getTonKhoChiTiet(Request $request){
        $idsp = $request->input('sanpham_id');
        $records = TonKho::where('sanpham_id', $idsp)->get();
        $tensp = SanPham::where('id', $idsp)->first();

        $mangchitietton = [];
        foreach ($records as $value)
        {
            $solo = LoSanXuat::find($value->losx_id);

            $carbonDate = Carbon::parse($value->ngayhethan);
            $ngayhh = $carbonDate->format('d/m/Y');

            $mangchitietton[] = [
                'solo' => $solo->solo,
                'soluong' => $value->soluong,
                'ngayhh' => $ngayhh
            ];
        }
        return response()->json(['mangchitietton' => $mangchitietton,
            'tenthuoc' => $tensp->tenthuoc]);
    }
}
