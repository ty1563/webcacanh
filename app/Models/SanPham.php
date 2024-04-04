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
        'gioi_thieu',
        "size_active",
        "tinh_trang",
        "id_danh_muc",
        "id_thuong_hieu",
    ];
    public function scopeActive($query){
        return $query->where("tinh_trang",1);
    }
    public function sizeCustoms()
    {
        return $this->hasMany(SizeCustom::class, 'id_san_pham');
    }
    public function danhMucs(){
        return $this->belongsTo(DanhMuc::class,"id","id_san_pham");
    }

    public function minMaxGiaBan()
    {
        $minMaxGiaBan = $this->sizeCustoms->reduce(function ($carry, $item) {
            if (!isset($carry['min']) || $item->gia_ban < $carry['min']) {
                $carry['min'] = $item->gia_ban;
            }
            if (!isset($carry['max']) || $item->gia_ban > $carry['max']) {
                $carry['max'] = $item->gia_ban;
            }
            return $carry;
        }, []);

        return $minMaxGiaBan;
    }
}
