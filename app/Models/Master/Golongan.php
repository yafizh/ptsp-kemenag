<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $table = "golongan";

    protected $fillable = [
        'nama'
    ];
}
