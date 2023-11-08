<?php

namespace App\Models\Permohonan\JenisPermohonan;

use Illuminate\Database\Eloquent\Model;

class PermohonanPendaftaranRumahIbadah extends Model
{
    protected $table = "permohonan_pendaftaran_rumah_ibadah";

    protected $fillable = [
        'id_permohonan',
        'id_rumah_ibadah',
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
