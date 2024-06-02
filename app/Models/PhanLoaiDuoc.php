<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhanLoaiDuoc extends Model
{
    protected $table = 'phanloaiduoc';

    public function SanPham(): HasMany
    {
        return $this->hasMany(SanPham::class, 'phanloaiduoc_id', 'id');
    }
}
