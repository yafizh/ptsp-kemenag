<?php

namespace App\Models;

use App\Enums\User\UserStatus;
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
}
