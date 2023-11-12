<?php

namespace App\Models\Permohonan;

use App\Models\Permohonan\JenisPermohonan\PermohonanMagangPKL;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Permohonan extends Model
{
    protected $table = "permohonan";

    protected $fillable = [
        'tanggal_permohonan'
    ];

    public function tanggalPermohonanFormatIndonesia(): string
    {
        return Carbon::createFromDate($this->tanggal_permohonan)->locale('ID')->format('d F Y');
    }

    public function pemohon(): HasOne
    {
        return $this->hasOne(Pemohon::class, 'id_permohonan', 'id');
    }

    public function permohonanTerverifikasi(): HasOne
    {
        return $this->hasOne(PermohonanTerverifikasi::class, 'id_permohonan', 'id');
    }

    public function magangPKL(): HasOne
    {
        return $this->HasOne(PermohonanMagangPKL::class, 'id_permohonan', 'id');
    }
}
