<?php

namespace App\Models\Permohonan;

use App\Enums\Permohonan\PermohonanStatus;
use Illuminate\Database\Eloquent\Model;

class PermohonanTerverifikasi extends Model
{
    protected $table = "permohonan_terverifikasi";

    protected $fillable = [
        'id_permohonan',
        'id_pengguna',
        'tanggal_verifikasi',
        'keterangan',
        'status'
    ];

    protected $casts = [
        'status' => PermohonanStatus::class
    ];
}
