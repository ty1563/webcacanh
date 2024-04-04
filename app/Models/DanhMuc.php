<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;
    protected $table = "danh_mucs";
    protected $fillable = [
        "ten_danh_muc",
        "slug_danh_muc",
        "mo_ta",
        "xep_hang",
        'id_chuyen_muc',
    ];
    public function sanPhams(){
        return $this->hasMany(SanPham::class,'id_danh_muc');
    }
    public function chuyenMucs(){
        return $this->belongsTo(ChuyenMuc::class);
    }
}
