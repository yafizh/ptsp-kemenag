<?php

namespace App\Models\Pegawai;

use Illuminate\Database\Eloquent\Model;

class PegawaiFoto extends Model
{
    protected $table = "pegawai_foto";

    protected $fillable = [
        'id_pegawai',
        'nama_file',
        'nama_file_asli'
    ];
}
