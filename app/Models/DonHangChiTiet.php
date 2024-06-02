<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonHangChiTiet extends Model
{
    protected $table = 'donhangchitiet';

    public function DonHang(): BelongsTo
    {
        return $this->belongsTo(DonHang::class, 'donhang_id', 'id');
    }
    public function LoSanXuat(): BelongsTo
    {
        return $this->belongsTo(LoSanXuat::class, 'losx_id', 'id');
    }

    public function SanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'sanpham_id', 'id');
    }

    public function DonViTinh(): BelongsTo
    {
        return $this->belongsTo(DonViTinh::class, 'donvitinh_id', 'id');
    }

}
