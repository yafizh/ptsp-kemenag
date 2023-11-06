<?php

namespace App\Models\Permohonan\JenisPermohonan;

use Illuminate\Database\Eloquent\Model;

class PermohonanMagangPKL extends Model
{
    protected $table = "permohonan_magang_pkl";

    protected $fillable = [
        'id_permohonan',
        'nama',
        'asal_sekolah',
        'alamat_sekolah',
        'tanggal_mulai',
        'tanggal_selesai'
    ];
}
