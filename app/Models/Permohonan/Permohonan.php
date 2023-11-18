<?php

namespace App\Models\Permohonan;

use App\Models\Permohonan\JenisPermohonan\PermohonanMagangPKL;
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
        return $this->HasOne(PermohonanMagangPKL::class, 'id_permohonan', 'id');
    }

    public function ukurKiblat(): HasOne
    {
        return $this->HasOne(PermohonanUkurKiblat::class, 'id_permohonan', 'id');
    }
}
