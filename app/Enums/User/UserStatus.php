<?php

namespace App\Enums\User;

enum UserStatus: string
{
    case ADMIN = 'Admin';
    case PIMPINAN = 'Pimpinan';
    case PEGAWAI = 'Pegawai';

    public function route()
    {
        return match ($this) {
            UserStatus::ADMIN => 'admin',
            UserStatus::PIMPINAN => 'pimpinan',
            UserStatus::PEGAWAI => 'pegawai',
        };
    }
}
