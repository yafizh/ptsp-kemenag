<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class BiayaPerjalananDinas extends Model
{
    protected $table = "biaya_perjalanan_dinas";

    protected $fillable = [
        'tingkat',
        'range_dari',
        'range_sampai'
    ];
}
