<?php

namespace App\Models\Pengajuan\JenisPengajuan;

use App\Models\Master\JenisIzin;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanIzin extends Model
{
    protected $fillable = [
        'id_jenis_izin',
        'id_pengajuan',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan'
    ];

    protected $table = 'pengajuan_izin';

    public function jenisIzin(): BelongsTo
    {
        return $this->belongsTo(JenisIzin::class, 'id_jenis_izin', 'id');
    }

    public function tanggalMulaiFormatIndonesia(): string
    {
        $tanggalMulai = Carbon::createFromDate($this->tanggal_mulai)->locale('ID');
        return $tanggalMulai->day . " " . $tanggalMulai->getTranslatedMonthName() . " " . $tanggalMulai->year;
    }

    public function tanggalSelesaiFormatIndonesia(): string
    {
        $tanggalSelesai = Carbon::createFromDate($this->tanggal_selesai)->locale('ID');
        return $tanggalSelesai->day . " " . $tanggalSelesai->getTranslatedMonthName() . " " . $tanggalSelesai->year;
    }
}
