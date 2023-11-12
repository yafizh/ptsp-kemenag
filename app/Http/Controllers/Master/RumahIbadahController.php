<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\RumahIbadah;
use Illuminate\Http\Request;

class RumahIbadahController extends Controller
{
    public function index()
    {
        $rumahIbadah = RumahIbadah::orderBy('nama')->get();
        return view('dashboard.master.rumah-ibadah.index', compact('rumahIbadah'));
    }

    public function create()
    {
        return view('dashboard.master.rumah-ibadah.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        RumahIbadah::create([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/rumah-ibadah')->with('success', 'Berhasil menambah rumah ibadah.');
    }

    public function edit(RumahIbadah $rumahIbadah)
    {
        return view('dashboard.master.rumah-ibadah.edit', compact('rumahIbadah'));
    }

    public function update(Request $request, RumahIbadah $rumahIbadah)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $rumahIbadah->update([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/rumah-ibadah')->with('success', 'Berhasil memperbaharui rumah ibadah.');
    }

    public function destroy(RumahIbadah $rumahIbadah)
    {
        $rumahIbadah->delete();
        return redirect('/' . auth()->user()->status->route() . '/rumah-ibadah')->with('success', 'Berhasil menghapus rumah ibadah.');
    }
}
