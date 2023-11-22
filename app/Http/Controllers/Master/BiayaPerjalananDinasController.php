<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\BiayaPerjalananDinas;
use Illuminate\Http\Request;

class BiayaPerjalananDinasController extends Controller
{
    public function index()
    {
        $biayaPerjalanDinas = BiayaPerjalananDinas::orderBy('tingkat')->get();
        return view('dashboard.master.biaya-perjalanan-dinas.index', compact('biayaPerjalanDinas'));
    }

    public function create()
    {
        return view('dashboard.master.biaya-perjalanan-dinas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tingkat'       => 'required',
            'range_dari'    => 'required',
            'range_sampai'  => 'required',
        ]);

        BiayaPerjalananDinas::create([
            'tingkat'       => $validatedData['tingkat'],
            'range_dari'    => $validatedData['range_dari'],
            'range_sampai'  => $validatedData['range_sampai'],
        ]);

        return redirect('/' . auth()->user()->status->route() . '/biaya-perjalanan-dinas')->with('success', 'Berhasil menambah biaya perjalanan dinas.');
    }

    public function edit(BiayaPerjalananDinas $biayaPerjalananDinas)
    {
        return view('dashboard.master.biaya-perjalanan-dinas.edit', compact('biayaPerjalananDinas'));
    }

    public function update(Request $request, BiayaPerjalananDinas $biayaPerjalananDinas)
    {
        $validatedData = $request->validate([
            'tingkat'       => 'required',
            'range_dari'    => 'required',
            'range_sampai'  => 'required',
        ]);

        $biayaPerjalananDinas->update([
            'tingkat'       => $validatedData['tingkat'],
            'range_dari'    => $validatedData['range_dari'],
            'range_sampai'  => $validatedData['range_sampai'],
        ]);

        return redirect('/' . auth()->user()->status->route() . '/biaya-perjalanan-dinas')->with('success', 'Berhasil memperbaharui biaya perjalanan dinas.');
    }

    public function destroy(BiayaPerjalananDinas $biayaPerjalananDinas)
    {
        $biayaPerjalananDinas->delete();
        return redirect('/' . auth()->user()->status->route() . '/biaya-perjalanan-dinas')->with('success', 'Berhasil menghapus biaya perjalanan dinas.');
    }
}
