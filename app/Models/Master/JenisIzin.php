<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class JenisIzin extends Model
{
    protected $table = "jenis_izin";

    protected $fillable = [
        'nama'
    ];
}
