<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DonViTinh extends Model
{
    protected $table = 'donvitinh';

    public function SanPham(): HasMany
    {
        return $this->hasMany(SanPham::class, 'donvitinh_id', 'id');
    }
    public function DonHangChiTiet(): HasMany
    {
        return $this->hasMany(DonHangChiTiet::class, 'donvitinh_id', 'id');
    }
    public function PhieuKiemKhoChiTiet(): HasMany
    {
        return $this->hasMany(PhieuKiemKhoChiTiet::class, 'donvitinh_id', 'id');
    }
}
