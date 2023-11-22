<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    public function index()
    {
        $golongan = Golongan::orderBy('nama')->get();
        return view('dashboard.master.golongan.index', compact('golongan'));
    }

    public function create()
    {
        return view('dashboard.master.golongan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        Golongan::create([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/golongan')->with('success', 'Berhasil menambah golongan.');
    }

    public function edit(Golongan $golongan)
    {
        return view('dashboard.master.golongan.edit', compact('golongan'));
    }

    public function update(Request $request, Golongan $golongan)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $golongan->update([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/golongan')->with('success', 'Berhasil memperbaharui golongan.');
    }

    public function destroy(Golongan $golongan)
    {
        $golongan->delete();
        return redirect('/' . auth()->user()->status->route() . '/golongan')->with('success', 'Berhasil menghapus golongan.');
    }
}
