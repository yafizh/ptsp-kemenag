<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\JenisCuti;
use Illuminate\Http\Request;

class JenisCutiController extends Controller
{
    public function index()
    {
        $jenisCuti = JenisCuti::orderBy('nama')->get();
        return view('dashboard.master.jenis-cuti.index', compact('jenisCuti'));
    }

    public function create()
    {
        return view('dashboard.master.jenis-cuti.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        JenisCuti::create([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/jenis-cuti')->with('success', 'Berhasil menambah jenis cuti.');
    }

    public function edit(JenisCuti $jenisCuti)
    {
        return view('dashboard.master.jenis-cuti.edit', compact('jenisCuti'));
    }

    public function update(Request $request, JenisCuti $jenisCuti)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $jenisCuti->update([
            'nama' => $validatedData['nama']
        ]);

        return redirect('/' . auth()->user()->status->route() . '/jenis-cuti')->with('success', 'Berhasil memperbaharui jenis cuti.');
    }

    public function destroy(JenisCuti $jenisCuti)
    {
        $jenisCuti->delete();
        return redirect('/' . auth()->user()->status->route() . '/jenis-cuti')->with('success', 'Berhasil menghapus jenis cuti.');
    }
}
