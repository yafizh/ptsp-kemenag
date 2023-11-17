<?php

namespace App\Models\Pengajuan\JenisPengajuan;

use App\Models\Master\JenisCuti;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanCuti extends Model
{
    protected $fillable = [
        'id_jenis_cuti',
        'id_pengajuan',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    protected $table = 'pengajuan_cuti';

    public function jenisCuti(): BelongsTo
    {
        return $this->belongsTo(JenisCuti::class, 'id_jenis_cuti', 'id');
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
