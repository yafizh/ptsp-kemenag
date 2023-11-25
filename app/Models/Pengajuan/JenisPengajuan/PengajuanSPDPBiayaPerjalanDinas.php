<?php

namespace App\Models\Pengajuan\JenisPengajuan;

use Illuminate\Database\Eloquent\Model;

class PengajuanSPDPBiayaPerjalanDinas extends Model
{
    protected $fillable = [
        'id_pengajuan_spdp',
        'id_biaya_perjalanan_dinas'
    ];

    protected $table = 'pengajuan_spdp_biaya_perjalanan_dinas';
}
