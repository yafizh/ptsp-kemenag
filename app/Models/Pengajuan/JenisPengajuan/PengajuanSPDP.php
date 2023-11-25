<?php

namespace App\Models\Pengajuan\JenisPengajuan;

use App\Models\Master\BiayaPerjalananDinas;
use App\Models\Master\JenisKendaraan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class PengajuanSPDP extends Model
{
    protected $fillable = [
        'id_jenis_kendaraan',
        'id_pengajuan',
        'tanggal_berangkat',
        'tanggal_kembali',
        'tempat_berangkat',
        'tempat_tujuan',
        'maksud_perjalanan_dinas'
    ];

    protected $table = 'pengajuan_spdp';

    public function jenisKendaraan(): BelongsTo
    {
        return $this->belongsTo(JenisKendaraan::class, 'id_jenis_kendaraan', 'id');
    }

    public function biayaPerjalananDinas(): HasOneThrough
    {
        return $this->hasOneThrough(
            BiayaPerjalananDinas::class,
            PengajuanSPDPBiayaPerjalanDinas::class,
            'id_pengajuan_spdp',
            'id',
            'id',
            'id_biaya_perjalanan_dinas'
        );
    }

    public function tanggalBerangkatFormatIndonesia(): string
    {
        $tanggalBerangkat = Carbon::createFromDate($this->tanggal_berangkat)->locale('ID');
        return $tanggalBerangkat->day . " " . $tanggalBerangkat->getTranslatedMonthName() . " " . $tanggalBerangkat->year;
    }

    public function tanggalKembaliFormatIndonesia(): string
    {
        $tanggalKembali = Carbon::createFromDate($this->tanggal_kembali)->locale('ID');
        return $tanggalKembali->day . " " . $tanggalKembali->getTranslatedMonthName() . " " . $tanggalKembali->year;
    }

    public function lamaPerjalananDinas(): int
    {
        $tanggalBerangkat = Carbon::createFromDate($this->tanggal_berangkat);
        $tanggalKembali = Carbon::createFromDate($this->tanggal_kembali);
        return $tanggalBerangkat->diffInDays($tanggalKembali);
    }
}
