<?php

namespace App\Exports;

use App\Models\SanPham;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SanPhamExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    public function headings(): array
    {
        return [
            'tenthuoc',
            'nhomthuoc_id',
            'phanloaiduoc_id',
            'nhacungcap_id',
            'hangsanxuat_id',
            'donvitinh_id',
            'danhmucsanpham_id',
            'cachdung_id',
            'hoatchat',
            'kedon',
            'nguonnhap',
            'quocgia',
            'gianhap',
            'giaxuat',
        ];
    }
    public function map($row): array
    {
        return [
            $row->tenthuoc,
            $row->nhomthuoc_id,
            $row->phanloaiduoc_id,
            $row->nhacungcap_id,
            $row->hangsanxuat_id,
            $row->donvitinh_id,
            $row->danhmucsanpham_id,
            $row->cachdung_id,
            $row->hoatchat,
            $row->kedon,
            $row->nguonnhap,
            $row->quocgia,
            $row->gianhap,
            $row->giaxuat,
        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }
    public function collection()
    {
        return SanPham::all();
    }
}
