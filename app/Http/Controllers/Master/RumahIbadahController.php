<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RumahIbadahController extends Controller
{
    public function index()
    {
        return view('dashboard.master.rumah-ibadah.index');
    }

    public function create()
    {
        return view('dashboard.master.rumah-ibadah.create');
    }
}
