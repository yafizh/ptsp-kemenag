<?php

namespace App\Http\Controllers\Permohonan;

use App\Enums\Permohonan\PermohonanJenis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function index()
    {
        return view('permohonan.index');
    }

    public function magangPKL()
    {
        return view('permohonan.magang-pkl');
    }

    public function pengukuranKiblat()
    {
        return view('permohonan.pengukuran-kiblat');
    }

    public function pendaftaranRumahIbadah()
    {
        return view('permohonan.pendaftaran-rumah-ibadah');
    }
}
