<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CachDung extends Model
{
    protected $table = 'cachdung';
    public function SanPham(): HasMany
    {
        return $this->hasMany(SanPham::class, 'cachdung_id', 'id');
    }
}
