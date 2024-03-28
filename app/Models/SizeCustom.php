<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeCustom extends Model
{
    use HasFactory;
    protected $table = "size_customs";
    protected $fillable = [
        'size',
        'gia_ban',
        'id_san_pham',
    ];
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class);
    }
}
