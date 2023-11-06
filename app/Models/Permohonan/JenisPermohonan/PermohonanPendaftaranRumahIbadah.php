<?php

namespace App\Models\Permohonan\JenisPermohonan;

use Illuminate\Database\Eloquent\Model;

class PermohonanPendaftaranRumahIbadah extends Model
{
    protected $table = "permohonan_pendaftaran_rumah_ibadah";

    protected $fillable = [
        'id_rumah_ibadah',
        'id_permohonan',
        'nomor_telepon_ketua',
        'nama_rumah_ibadah',
        'alamat',
        'kelurahan',
        'kecamatan',
        'tahun_berdiri',
        'luas_tanah',
        'luas_bangunan'
    ];
}
