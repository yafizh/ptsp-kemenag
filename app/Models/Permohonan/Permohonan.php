<?php

namespace App\Models\Permohonan;

use App\Models\Permohonan\JenisPermohonan\PermohonanMagangPKL;
use App\Models\Permohonan\JenisPermohonan\PermohonanPendaftaranRumahIbadah;
use App\Models\Permohonan\JenisPermohonan\PermohonanRiset;
use App\Models\Permohonan\JenisPermohonan\PermohonanUkurKiblat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Permohonan extends Model
{
    protected $table = "permohonan";

    protected $fillable = [
        'tanggal_waktu_permohonan'
    ];

    public function tanggalPermohonanFormatIndonesia(): string
    {
        $tanggalPermohonan = Carbon::createFromDate($this->tanggal_waktu_permohonan)->locale('ID');
        return $tanggalPermohonan->day . " " . $tanggalPermohonan->getTranslatedMonthName() . " " . $tanggalPermohonan->year;
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
        return $this->hasOne(PermohonanMagangPKL::class, 'id_permohonan', 'id');
    }

    public function ukurKiblat(): HasOne
    {
        return $this->hasOne(PermohonanUkurKiblat::class, 'id_permohonan', 'id');
    }

    public function pendaftaranRumahIbadah(): HasOne
    {
        return $this->hasOne(PermohonanPendaftaranRumahIbadah::class, 'id_permohonan', 'id');
    }

    public function riset(): HasOne
    {
        return $this->hasOne(PermohonanRiset::class, 'id_permohonan', 'id');
    }
}
