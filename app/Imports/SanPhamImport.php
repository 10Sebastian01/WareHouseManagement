<?php

namespace App\Imports;

use App\Models\SanPham;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SanPhamImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SanPham([
            'tenthuoc' => $row['tenthuoc'],
            'danhmucsanpham_id' => $row['danhmucsanpham_id'],
            'nhomthuoc_id' => $row['nhomthuoc_id'],
            'phanloaiduoc_id' => $row['phanloaiduoc_id'],
            'hoatchat' => $row['hoatchat'],
            'donvitinh_id' => $row['donvitinh_id'],
            'cachdung_id' => $row['cachdung_id'],
            'kedon' => $row['kedon'],
            'hangsanxuat_id' => $row['hangsanxuat_id'],
            'nhacungcap_id' => $row['nhacungcap_id'],
            'quocgia' => $row['quocgia'],
            'nguonnhap' => $row['nguonnhap'],
            'gianhap' => $row['gianhap'],
            'giaxuat' => $row['giaxuat'],

        ]);
    }
}
