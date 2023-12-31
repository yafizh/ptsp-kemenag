<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.index', [
            'pengguna' => 'Admin'
        ]);
    }

    public function pimpinan()
    {
        return view('dashboard.index', [
            'pengguna' => 'Pimpinan'
        ]);
    }

    public function pegawai()
    {
        return view('dashboard.index', [
            'pengguna' => 'Pegawai'
        ]);
    }
}
