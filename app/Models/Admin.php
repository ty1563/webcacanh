<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use HasFactory;
    protected $table = "admins";
    protected $fillable = [
        "username",
        "email",
        "password",
        "ho_ten",
        "sdt",
        "quyen",
        "hash_active",
        "hash_reset",
        "is_master"
    ];
    public function thongTinAdmins()
    {
        return $this->hasMany(ThongTinAdmin::class, 'id_admin');
    }
}
