<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;
    protected $table = "don_hangs";
    protected $fillable = [
        "ten",
        "email",
        "dia_chi",
        "phone",
        "dia_chi_cu_the",
        "tien_hang",
        "ma_giam_gia",
        "total",
        "hash",
        "giao_hang",
        "thanh_toan",
        "id_khach_hang",
    ];
    public function khachHangs(){
        return $this->belongsTo(KhachHang::class,'id_khach_hang','id');
    }
}
