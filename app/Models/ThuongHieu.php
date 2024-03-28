<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuongHieu extends Model
{
    use HasFactory;
    protected $table = "thuong_hieus";
    protected $fillable = [
        "ten_thuong_hieu",
        "slug_thuong_hieu",
        "thong_tin_thuong_hieu",
        'id_danh_muc',
    ];
}
