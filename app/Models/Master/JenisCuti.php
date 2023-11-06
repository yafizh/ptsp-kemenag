<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    protected $table = "jenis_cuti";

    protected $fillable = [
        'nama'
    ];
}
