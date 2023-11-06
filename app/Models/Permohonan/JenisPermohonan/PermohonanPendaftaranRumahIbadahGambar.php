<?php

namespace App\Models\Permohonan\JenisPermohonan;

use Illuminate\Database\Eloquent\Model;

class PermohonanPendaftaranRumahIbadahGambar extends Model
{
    protected $table = "permohonan_pendaftaran_rumah_ibadah_gambar";

    protected $fillable = [
        'id_permohonan_pendaftaran_rumah_ibadah',
        'nama_file',
        'nama_file_original'
    ];
}
