<?php

namespace App\Models\Permohonan\JenisPermohonan;

use App\Models\Permohonan\Permohonan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class, 'id_permohonan', 'id');
    }
}
