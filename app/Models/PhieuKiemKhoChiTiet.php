<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhieuKiemKhoChiTiet extends Model
{
    protected $table = 'phieukiemkhochitiet';

    public function PhieuKiemKho(): BelongsTo
    {
        return $this->belongsTo(PhieuKiemKho::class, 'phieukiemkho_id', 'id');
    }

    public function SanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'sanpham_id', 'id');
    }

    public function LoSanXuat(): BelongsTo
    {
        return $this->belongsTo(LoSanXuat::class, 'losx_id', 'id');
    }

    public function DonViTinh(): BelongsTo
    {
        return $this->belongsTo(DonViTinh::class, 'donvitinh_id', 'id');
    }
}
