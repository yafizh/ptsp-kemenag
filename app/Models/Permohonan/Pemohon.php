<?php

namespace App\Models\Permohonan;

use Illuminate\Database\Eloquent\Model;

class Pemohon extends Model
{
    protected $table = "pemohon";

    protected $fillable = [
        'nama',
        'nomor_telepon'
    ];
}
