<?php

namespace App\Models;

use App\Enums\Pegawai\PegawaiJabatan;
use App\Enums\PendidikanTerakhir;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = "pegawai";

    protected $fillable = [
        'nip',
        'nama',
        'jabatan',
        'jenis_kelamin',
        'nomor_telepon',
        'pendidikan_terakhir',
        'tmt',
        'tanggal_lahir',
        'alamat',
        'file_foto'
    ];

    protected $casts = [
        'jabatan' => PegawaiJabatan::class,
        'jenis_kelamin' => PegawaiJabatan::class,
        'pendidikan_terakhir' => PendidikanTerakhir::class,
    ];
}
