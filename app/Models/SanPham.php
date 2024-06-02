<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SanPham extends Model
{
    protected $table = 'sanpham';
    protected $fillable = [
        'tenthuoc',
         'nhomthuoc_id',
         'phanloaiduoc_id',
         'nhacungcap_id',
         'hangsanxuat_id',
         'donvitinh_id',
         'danhmucsanpham_id',
         'cachdung_id',
         'hoatchat',
         'kedon',
         'nguonnhap',
         'quocgia',
         'gianhap',
         'giaxuat',
         ];

    public function LoSanXuat(): HasMany
    {
        return $this->hasMany(LoSanXuat::class, 'sanpham_id', 'id');
    }
    public function DonHangChiTiet(): HasMany
    {
        return $this->hasMany(DonHangChiTiet::class, 'sanpham_id', 'id');
    }
    public function TonKho(): HasMany
    {
        return $this->hasMany(TonKho::class, 'sanpham_id', 'id');
    }
    public function DanhMucSanPham(): BelongsTo
    {
        return $this->belongsTo(DanhMucSanPham::class, 'danhmucsanpham_id', 'id');
    }
    public function NhomThuoc(): BelongsTo
    {
        return $this->belongsTo(NhomThuoc::class, 'nhomthuoc_id', 'id');
    }
    public function PhanLoaiDuoc(): BelongsTo
    {
        return $this->belongsTo(PhanLoaiDuoc::class, 'phanloaiduoc_id', 'id');
    }
    public function DonViTinh(): BelongsTo
    {
        return $this->belongsTo(DonViTinh::class, 'donvitinh_id', 'id');
    }
    public function CachDung(): BelongsTo
    {
        return $this->belongsTo(CachDung::class, 'cachdung_id', 'id');
    }
    public function HangSanXuat(): BelongsTo
    {
        return $this->belongsTo(HangSanXuat::class, 'hangsanxuat_id', 'id');
    }
    public function NhaCungCap(): BelongsTo
    {
        return $this->belongsTo(NhaCungCap::class, 'nhacungcap_id', 'id');
    }
}
