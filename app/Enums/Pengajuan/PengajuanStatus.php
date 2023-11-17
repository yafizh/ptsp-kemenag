<?php

namespace App\Enums\Pengajuan;

enum PengajuanStatus: string
{
    case DITOLAK = "Ditolak";
    case DISETUJUI = "Disetujui";
}
