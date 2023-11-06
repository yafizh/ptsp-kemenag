<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JenisCutiController extends Controller
{
    public function index()
    {
        return view('dashboard.master.jenis-cuti.index');
    }

    public function create()
    {
        return view('dashboard.master.jenis-cuti.create');
    }
}
