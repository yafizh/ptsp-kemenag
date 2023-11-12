<?php

namespace App\Enums\Pegawai;

use App\Enums\User\UserStatus;

enum PegawaiJabatan: string
{
    case KEPALA_KEMENAG = 'Kepala Kemenag';
    case KABAG_TU = 'Kepala Bagian Tata Usaha';
    case PEGAWAI = 'Pegawai';

    public function statusUser()
    {
        return match ($this) {
            PegawaiJabatan::KEPALA_KEMENAG => UserStatus::PIMPINAN,
            PegawaiJabatan::KABAG_TU => UserStatus::PIMPINAN,
            PegawaiJabatan::PEGAWAI => UserStatus::PEGAWAI,
        };
    }
}
