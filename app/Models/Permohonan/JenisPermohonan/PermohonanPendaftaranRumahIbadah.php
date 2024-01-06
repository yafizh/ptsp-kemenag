<?php

namespace App\Models\Permohonan\JenisPermohonan;

use App\Models\Master\RumahIbadah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PermohonanPendaftaranRumahIbadah extends Model
{
    protected $table = "permohonan_pendaftaran_rumah_ibadah";

    protected $fillable = [
        'id_permohonan',
        'id_rumah_ibadah',
        'nama_ketua',
        'nomor_telepon_ketua',
        'nama_rumah_ibadah',
        'alamat_rumah_ibadah',
        'nomor_telepon_rumah_ibadah',
        'kelurahan',
        'kecamatan',
        'tahun_berdiri',
        'luas_tanah',
        'luas_bangunan'
    ];

    public function rumahIbadah(): BelongsTo
    {
        return $this->belongsTo(RumahIbadah::class, 'id_rumah_ibadah', 'id');
    }

    public function foto(): HasMany
    {
        return $this->hasMany(PermohonanPendaftaranRumahIbadahGambar::class, 'id_permohonan_pendaftaran_rumah_ibadah', 'id');
    }

    public function dokumenLampiran(): HasMany
    {
        return $this->hasMany(PermohonanPendaftaranRumahIbadahDokumenLampiran::class, 'id_permohonan_pendaftaran_rumah_ibadah', 'id');
    }
}
