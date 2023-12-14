<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\JenisIzin;
use Illuminate\Http\Request;

class JenisIzinController extends Controller
{
    public function index()
    {
        $jenisIzin = JenisIzin::orderBy('nama')->get();
        return view('dashboard.master.jenis-izin.index', compact('jenisIzin'));
    }

    public function create()
    {
        return view('dashboard.master.jenis-izin.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        JenisIzin::create([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/jenis-izin')->with('success', 'Berhasil menambah jenis izin.');
    }

    public function edit(JenisIzin $jenisIzin)
    {
        return view('dashboard.master.jenis-izin.edit', compact('jenisIzin'));
    }

    public function update(Request $request, JenisIzin $jenisIzin)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $jenisIzin->update([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/jenis-izin')->with('success', 'Berhasil memperbaharui jenis izin.');
    }

    public function destroy(JenisIzin $jenisIzin)
    {
        $jenisIzin->delete();
        return redirect('/' . auth()->user()->status->route() . '/jenis-izin')->with('success', 'Berhasil menghapus jenis izin.');
    }
}
