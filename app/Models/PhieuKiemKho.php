<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class PhieuKiemKho extends Model
{
    protected $table = 'phieukiemkho';

    protected $fillable = ['maphieukiem'];

    public function NguoiDung(): BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'nguoidung_id', 'id');
    }
    public function PhieuKiemKhoChiTiet(): HasMany
    {
        return $this->hasMany(PhieuKiemKhoChiTiet::class, 'phieukiemkho_id', 'id');
    }
    public function TrangThai(): BelongsTo
    {
        return $this->belongsTo(TrangThai::class, 'trangthai_id', 'id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($phieuKiemKho) {
            // Tạo mã phiếu kiểm kho mới
            $phieuKiemKho->maphieukiem = 'KK' . strtoupper(Str::random(7));
        });
    }
}
