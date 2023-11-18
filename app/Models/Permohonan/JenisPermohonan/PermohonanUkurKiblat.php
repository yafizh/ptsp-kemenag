<?php

namespace App\Models\Permohonan\JenisPermohonan;

use Illuminate\Database\Eloquent\Model;

class PermohonanUkurKiblat extends Model
{
    protected $table = "permohonan_ukur_kiblat";

    protected $fillable = [
        'id_permohonan',
        'nama_ketua',
        'nomor_telepon_ketua',
        'nama_rumah_ibadah',
        'alamat_rumah_ibadah',
        'nomor_telepon_rumah_ibadah',
    ];
}
