<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JenisKendaraanController extends Controller
{
    public function index()
    {
        return view('dashboard.master.jenis-kendaraan.index');
    }

    public function create()
    {
        return view('dashboard.master.jenis-kendaraan.create');
    }
}
