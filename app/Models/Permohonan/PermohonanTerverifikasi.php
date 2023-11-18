<?php

namespace App\Models\Permohonan;

use App\Enums\Permohonan\PermohonanStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PermohonanTerverifikasi extends Model
{
    protected $table = "permohonan_terverifikasi";

    protected $fillable = [
        'id_permohonan',
        'id_pengguna',
        'tanggal_waktu_verifikasi',
        'keterangan',
        'status'
    ];

    protected $casts = [
        'status' => PermohonanStatus::class
    ];

    public function tanggalVerifikasiFormatIndonesia(): string
    {
        $tanggalVerifikasi = Carbon::createFromDate($this->tanggal_waktu_verifikasi)->locale('ID');
        return $tanggalVerifikasi->day . " " . $tanggalVerifikasi->getTranslatedMonthName() . " " . $tanggalVerifikasi->year;
    }
}
