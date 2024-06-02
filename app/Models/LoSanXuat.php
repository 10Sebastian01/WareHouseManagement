<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoSanXuat extends Model
{
    protected $table = 'losx';

    public function SanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'sanpham_id', 'id');
    }
}
