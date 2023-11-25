<?php

namespace App\Models\Pengajuan;

use App\Enums\Pengajuan\PengajuanStatus;
use App\Models\Pengguna;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanTerverifikasi extends Model
{
    protected $fillable = [
        'id_pengajuan',
        'id_pengguna',
        'tanggal_waktu_verifikasi',
        'keterangan',
        'status'
    ];

    protected $table = 'pengajuan_terverifikasi';

    protected $casts = [
        'status' => PengajuanStatus::class
    ];

    public function tanggalVerifikasiFormatIndoensia(): string
    {
        $tanggalVerifikasi = Carbon::createFromDate($this->tanggal_waktu_verifikasi)->locale('ID');
        return $tanggalVerifikasi->day . " " . $tanggalVerifikasi->getTranslatedMonthName() . " " . $tanggalVerifikasi->year;
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id');
    }
}
