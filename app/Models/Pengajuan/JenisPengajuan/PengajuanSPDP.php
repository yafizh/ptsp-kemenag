<?php

namespace App\Models\Pengajuan\JenisPengajuan;

use App\Models\Master\JenisKendaraan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanSPDP extends Model
{
    protected $fillable = [
        'id_jenis_kendaraan',
        'id_pengajuan',
        'tanggal_berangkat',
        'tanggal_kembali',
        'tujuan',
        'keterangan'
    ];

    protected $table = 'pengajuan_spdp';

    public function jenisKendaraan(): BelongsTo
    {
        return $this->belongsTo(JenisKendaraan::class, 'id_jenis_kendaraan', 'id');
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
}
