<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = "san_phams";
    protected $fillable = [
        "ten_san_pham",
        "slug_san_pham",
        "hinh_anh",
        "mo_ta",
        "gia_ban",
        "xep_hang",
        "size_active",
        "tinh_trang",
        "id_danh_muc",
        "id_thuong_hieu",
    ];
    public function sizeCustoms()
    {
        return $this->hasMany(SizeCustom::class, 'id_san_pham');
    }

}
