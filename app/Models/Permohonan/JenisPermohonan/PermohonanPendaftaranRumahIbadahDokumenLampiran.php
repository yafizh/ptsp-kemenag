<?php

namespace App\Models\Permohonan\JenisPermohonan;

use Illuminate\Database\Eloquent\Model;

class PermohonanPendaftaranRumahIbadahDokumenLampiran extends Model
{
    protected $table = "permohonan_pendaftaran_rumah_ibadah_dokumen_lampiran";

    protected $fillable = [
        'id_permohonan_pendaftaran_rumah_ibadah',
        'nama_file',
        'nama_file_asli'
    ];
}
