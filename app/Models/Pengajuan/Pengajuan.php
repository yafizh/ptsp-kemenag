<?php

namespace App\Models\Pengajuan;

use App\Models\Pengajuan\JenisPengajuan\PengajuanCuti;
use App\Models\Pengajuan\JenisPengajuan\PengajuanFasilitas;
use App\Models\Pengajuan\JenisPengajuan\PengajuanIzin;
use App\Models\Pengajuan\JenisPengajuan\PengajuanSPDP;
use App\Models\Pengguna;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengajuan extends Model
{
    protected $fillable = [
        'id_pengguna',
        'tanggal_waktu_pengajuan'
    ];

    protected $table = 'pengajuan';

    public function pengajuanFasilitas(): HasOne
    {
        return $this->hasOne(PengajuanFasilitas::class, 'id_pengajuan', 'id');
    }

    public function pengajuanIzin(): HasOne
    {
        return $this->hasOne(PengajuanIzin::class, 'id_pengajuan', 'id');
    }

    public function pengajuanCuti(): HasOne
    {
        return $this->hasOne(PengajuanCuti::class, 'id_pengajuan', 'id');
    }

    public function pengajuanSPDP(): HasOne
    {
        return $this->hasOne(PengajuanSPDP::class, 'id_pengajuan', 'id');
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id');
    }

    public function pengajuanTerverifikasi(): HasOne
    {
        return $this->hasOne(PengajuanTerverifikasi::class, 'id_pengajuan', 'id');
    }

    public function tanggalPengajuanFormatIndonesia(): string
    {
        return Carbon::createFromDate($this->tanggal_waktu_pengajuan)->locale('ID')->format('d F Y');
    }
}
