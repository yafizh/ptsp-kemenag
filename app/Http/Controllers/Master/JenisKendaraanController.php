<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\JenisKendaraan;
use Illuminate\Http\Request;

class JenisKendaraanController extends Controller
{
    public function index()
    {
        $jenisKendaraan = JenisKendaraan::orderBy('nama')->get();
        return view('dashboard.master.jenis-kendaraan.index', compact('jenisKendaraan'));
    }

    public function create()
    {
        return view('dashboard.master.jenis-kendaraan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        JenisKendaraan::create([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/jenis-kendaraan')->with('success', 'Berhasil menambah jenis kendaraan.');
    }

    public function edit(JenisKendaraan $jenisKendaraan)
    {
        return view('dashboard.master.jenis-kendaraan.edit', compact('jenisKendaraan'));
    }

    public function update(Request $request, JenisKendaraan $jenisKendaraan)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $jenisKendaraan->update([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/jenis-kendaraan')->with('success', 'Berhasil memperbaharui jenis kendaraan.');
    }

    public function destroy(JenisKendaraan $jenisKendaraan)
    {
        $jenisKendaraan->delete();
        return redirect('/' . auth()->user()->status->route() . '/jenis-kendaraan')->with('success', 'Berhasil menghapus jenis kendaraan.');
    }
}
