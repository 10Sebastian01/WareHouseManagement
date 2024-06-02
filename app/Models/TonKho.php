<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TonKho extends Model
{
    protected $table = 'tonkho';

    public function SanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'sanpham_id', 'id');
    }
    public function LoSanXuat(): BelongsTo
    {
        return $this->belongsTo(LoSanXuat::class, 'losx_id', 'id');
    }
    public function DonHang(): HasMany
    {
        return $this->hasMany(DonHang::class, 'donhang_id', 'id');
    }
}
