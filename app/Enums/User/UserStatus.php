<?php

namespace App\Enums\User;

enum UserStatus: string
{
    case ADMIN = 'Admin';
    case PIMPIMAN = 'Pimpinan';
    case PEGAWAI = 'Pegawai';

    public function route()
    {
        return match ($this) {
            UserStatus::ADMIN => 'admin',
            UserStatus::PIMPIMAN => 'pimpinan',
            UserStatus::PEGAWAI => 'pegawai',
        };
    }
}
