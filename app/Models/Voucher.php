<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = "vouchers";
    protected $fillable = [
        "code",
        "mo_ta",
        "giam_gia",
        "het_han",
        "max_uses",
        "id_user",
        "used",
        "status",
    ];
}
