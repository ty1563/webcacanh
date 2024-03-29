<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinAdmin extends Model
{
    use HasFactory;
    protected $table = "thong_tin_admins";
    protected $fillable = [
        "avatar",
        'github',
        "facebook",
        "mobile",
        "zalo",
        "messenger",
        "instagram",
        "twitter",
        "dia_chi_1",
        "dia_chi_2",
        'id_admin',
    ];
    public function admins(){
        return $this->belongsTo(Admin::class);
    }
}
