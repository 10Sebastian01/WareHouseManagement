<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KhachHang extends Model
{
    protected $table = 'khachhang';

    public function DonHang(): HasMany
    {
        return $this->hasMany(DonHang::class, 'khachang_id', 'id');
    }
}
