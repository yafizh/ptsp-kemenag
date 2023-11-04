<?php

namespace App\Enums\User;

enum UserStatus: string
{
    case ADMIN = 'Admin';
    case PIMPIMAN = 'Pimpinan';
    case PEGAWAI = 'Pegawai';
}
