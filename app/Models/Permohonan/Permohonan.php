<?php

namespace App\Models\Permohonan;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $table = "permohonan";

    protected $fillable = [
        'tanggal_permohonan'
    ];
}
