<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DanhMucSanPham extends Model
{
    protected $table = 'danhmucsanpham';
    public function SanPham(): HasMany
    {
        return $this->hasMany(SanPham::class, 'danhmucsanpham_id', 'id');
    }
}
