<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    public function index()
    {
        $pangkat = Pangkat::orderBy('nama')->get();
        return view('dashboard.master.pangkat.index', compact('pangkat'));
    }

    public function create()
    {
        return view('dashboard.master.pangkat.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        Pangkat::create([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/pangkat')->with('success', 'Berhasil menambah pangkat.');
    }

    public function edit(Pangkat $pangkat)
    {
        return view('dashboard.master.pangkat.edit', compact('pangkat'));
    }

    public function update(Request $request, Pangkat $pangkat)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $pangkat->update([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/pangkat')->with('success', 'Berhasil memperbaharui pangkat.');
    }

    public function destroy(Pangkat $pangkat)
    {
        $pangkat->delete();
        return redirect('/' . auth()->user()->status->route() . '/pangkat')->with('success', 'Berhasil menghapus pangkat.');
    }
}
