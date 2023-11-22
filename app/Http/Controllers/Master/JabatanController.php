<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::orderBy('nama')->get();
        return view('dashboard.master.jabatan.index', compact('jabatan'));
    }

    public function create()
    {
        return view('dashboard.master.jabatan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        Jabatan::create([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/jabatan')->with('success', 'Berhasil menambah jabatan.');
    }

    public function edit(Jabatan $jabatan)
    {
        return view('dashboard.master.jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $jabatan->update([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/jabatan')->with('success', 'Berhasil memperbaharui jabatan.');
    }

    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();
        return redirect('/' . auth()->user()->status->route() . '/jabatan')->with('success', 'Berhasil menghapus jabatan.');
    }
}
