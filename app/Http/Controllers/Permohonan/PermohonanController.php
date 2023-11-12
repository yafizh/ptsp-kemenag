<?php

namespace App\Http\Controllers\Permohonan;

use App\Http\Controllers\Controller;
use App\Models\Permohonan\JenisPermohonan\PermohonanMagangPKL;
use App\Models\Permohonan\Pemohon;
use App\Models\Permohonan\Permohonan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermohonanController extends Controller
{
    public function index()
    {
        return view('permohonan.index');
    }

    public function magangPKL()
    {
        return view('permohonan.magang-pkl');
    }

    public function storeMagangPKL(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pemohon'          => 'required',
            'nomor_telepon_pemohon' => 'required',
            'nama'                  => 'required',
            'asal_sekolah'          => 'required',
            'alamat_sekolah'        => 'required',
            'tanggal_mulai'         => 'required',
            'tanggal_selesai'       => 'required'
        ]);

        DB::transaction(function () use ($validatedData) {
            $permohonan = Permohonan::create([
                'tanggal_permohonan' => Carbon::now('Asia/Kuala_Lumpur')->format("Y-m-d")
            ]);

            PermohonanMagangPKL::create([
                'id_permohonan'     => $permohonan->id,
                'nama'              => $validatedData['nama'],
                'asal_sekolah'      => $validatedData['asal_sekolah'],
                'alamat_sekolah'    => $validatedData['alamat_sekolah'],
                'tanggal_mulai'     => $validatedData['tanggal_mulai'],
                'tanggal_selesai'   => $validatedData['tanggal_selesai']
            ]);

            Pemohon::create([
                'id_permohonan' => $permohonan->id,
                'nama'          => $validatedData['nama_pemohon'],
                'nomor_telepon' => $validatedData['nomor_telepon_pemohon']
            ]);
        });

        return redirect('/permohonan-magang-pkl')->with('success', 'Berhasil mengajukan permohonan magang/pkl.');
    }

    public function pengukuranKiblat()
    {
        return view('permohonan.pengukuran-kiblat');
    }

    public function pendaftaranRumahIbadah()
    {
        return view('permohonan.pendaftaran-rumah-ibadah');
    }
}
