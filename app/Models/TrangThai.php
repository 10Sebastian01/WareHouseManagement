<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrangThai extends Model
{
    protected $table = 'trangthai';
    public function DonHang(): BelongsTo
    {
        return $this->belongsTo(DonHang::class, 'donhang_id', 'id');
    }
    public function PhieuKiemKho(): BelongsTo
    {
        return $this->belongsTo(PhieuKiemKho::class, 'phieukiemkho_id', 'id');
    }
}
