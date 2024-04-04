<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KienThuc extends Model
{
    use HasFactory;
    protected $table = "kien_thucs";
    protected $fillable = [
        "title",
        "slug",
        "mo_ta",
        "noi_dung",
        "hinh_anh",
        'date',
        'list_san_pham',
        'list_tag',
        'tinh_trang',
    ];
    public function scopeActive($query){
        return $query->where("tinh_trang",1);
    }
}
