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
    }

    public function pegawai()
    {
    }
}
