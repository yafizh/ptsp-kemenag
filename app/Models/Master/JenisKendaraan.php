<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class JenisKendaraan extends Model
{
    protected $table = "jenis_kendaraan";

    protected $fillable = [
        'nama'
    ];
}
