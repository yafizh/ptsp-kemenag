<?php

namespace App\Http\Controllers\Permohonan;

use App\Http\Controllers\Controller;
use App\Models\Permohonan\JenisPermohonan\PermohonanMagangPKL;
use App\Models\Permohonan\JenisPermohonan\PermohonanUkurKiblat;
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

    public function storePengukuranKiblat(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pemohon'                  => 'required',
            'nomor_telepon_pemohon'         => 'required',
            'nama_ketua'                    => 'required',
            'nomor_telepon_ketua'           => 'required',
            'alamat_rumah_ibadah'           => 'required',
            'nama_rumah_ibadah'             => 'required',
            'nomor_telepon_rumah_ibadah'    => 'required'
        ]);

        DB::transaction(function () use ($validatedData) {
            $permohonan = Permohonan::create([
                'tanggal_waktu_permohonan' => Carbon::now('Asia/Kuala_Lumpur')->format("Y-m-d H:i:s")
            ]);

            PermohonanUkurKiblat::create([
                'id_permohonan'              => $permohonan->id,
                'nama_ketua'                 => $validatedData['nama_ketua'],
                'nomor_telepon_ketua'        => $validatedData['nomor_telepon_ketua'],
                'nama_rumah_ibadah'          => $validatedData['nama_rumah_ibadah'],
                'alamat_rumah_ibadah'        => $validatedData['alamat_rumah_ibadah'],
                'nomor_telepon_rumah_ibadah' => $validatedData['nomor_telepon_rumah_ibadah']
            ]);

            Pemohon::create([
                'id_permohonan' => $permohonan->id,
                'nama'          => $validatedData['nama_pemohon'],
                'nomor_telepon' => $validatedData['nomor_telepon_pemohon']
            ]);
        });

        return redirect('/permohonan-pengukuran-kiblat')->with('success', 'Berhasil mengajukan permohonan pengukuran kiblat.');
    }

    public function pendaftaranRumahIbadah()
    {
        return view('permohonan.pendaftaran-rumah-ibadah');
    }
}
