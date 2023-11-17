<?php

namespace App\Models;

use App\Enums\User\UserStatus;
use App\Models\Pegawai\Pegawai;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $table = "pengguna";

    protected $fillable = [
        'username',
        'password',
        'status'
    ];

    protected $casts = [
        'password' => 'hashed',
        'status' => UserStatus::class
    ];

    public function pegawai(): HasOne
    {
        return $this->hasOne(Pegawai::class, 'id_pengguna', 'id');
    }
}
