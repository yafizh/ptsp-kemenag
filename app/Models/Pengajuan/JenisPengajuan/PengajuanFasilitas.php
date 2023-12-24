<?php

namespace App\Models\Pengajuan\JenisPengajuan;

use Illuminate\Database\Eloquent\Model;

class PengajuanFasilitas extends Model
{
    protected $fillable = [
        'id_pengajuan',
        'fasilitas',
        'keperluan'
    ];

    protected $table = 'pengajuan_fasilitas';
}
