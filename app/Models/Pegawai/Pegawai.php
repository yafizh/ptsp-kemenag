<?php

namespace App\Models\Pegawai;

use App\Enums\Pegawai\PegawaiJabatan;
use App\Enums\Umum\JenisKelamin;
use App\Enums\Umum\PendidikanTerakhir;
use App\Models\Pengguna;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pegawai extends Model
{
    protected $table = "pegawai";

    protected $fillable = [
        'id_pengguna',
        'nip',
        'nama',
        'jabatan',
        'jenis_kelamin',
        'nomor_telepon',
        'pendidikan_terakhir',
        'tmt',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat'
    ];

    protected $casts = [
        'jabatan'               => PegawaiJabatan::class,
        'jenis_kelamin'         => JenisKelamin::class,
        'pendidikan_terakhir'   => PendidikanTerakhir::class,
    ];

    public function foto(): HasOne
    {
        return $this->hasOne(PegawaiFoto::class, 'id_pegawai', 'id');
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id');
    }

    public function tmtFormatIndonesia(): string
    {
        return Carbon::createFromDate($this->tmt)->locale('ID')->format("d F Y");
    }

    public function tanggalLahirFormatIndonesia(): string
    {
        return Carbon::createFromDate($this->tanggal_lahir)->locale('ID')->format("d F Y");
    }
}
