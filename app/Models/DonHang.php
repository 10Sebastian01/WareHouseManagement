<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DonHang extends Model
{
    protected $table = 'donhang';

    public function NguoiDung(): BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'nguoidung_id', 'id');
    }

    public function TrangThai(): BelongsTo
    {
        return $this->belongsTo(TrangThai::class, 'trangthai_id', 'id');
    }

    public function DonHangChiTiet(): HasMany
    {
        return $this->hasMany(DonHangChiTiet::class, 'donhang_id', 'id');
    }
    public function NhaCungCap(): BelongsTo
    {
        return $this->belongsTo(NhaCungCap::class, 'nhacungcap_id', 'id');
    }
    public function KhachHang(): BelongsTo
    {
        return $this->belongsTo(KhachHang::class, 'khachhang_id', 'id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($donHang) {
            $maDonHangPrefix = ($donHang->loaidonhang == 'nhaphang') ? 'NH' : 'XH';
            $randomSuffix = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 7); // Tạo chuỗi ngẫu nhiên
            $donHang->madon = $maDonHangPrefix . $randomSuffix;
        });
    }
}
