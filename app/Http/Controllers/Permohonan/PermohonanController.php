<?php

namespace App\Http\Controllers\Permohonan;

use App\Http\Controllers\Controller;
use App\Models\Master\RumahIbadah;
use App\Models\Permohonan\JenisPermohonan\PermohonanMagangPKL;
use App\Models\Permohonan\JenisPermohonan\PermohonanPendaftaranRumahIbadah;
use App\Models\Permohonan\JenisPermohonan\PermohonanPendaftaranRumahIbadahDokumenLampiran;
use App\Models\Permohonan\JenisPermohonan\PermohonanPendaftaranRumahIbadahGambar;
use App\Models\Permohonan\JenisPermohonan\PermohonanRiset;
use App\Models\Permohonan\JenisPermohonan\PermohonanUkurKiblat;
use App\Models\Permohonan\Pemohon;
use App\Models\Permohonan\Permohonan;
use App\Models\UploadFile;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
                'tanggal_waktu_permohonan' => Carbon::now('Asia/Kuala_Lumpur')->format("Y-m-d H:i:s")
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
        $rumahIbadah = RumahIbadah::orderBy('nama')->get();
        return view('permohonan.pendaftaran-rumah-ibadah', compact('rumahIbadah'));
    }

    public function storePendaftaranRumahIbadah(Request $request)
    {
        $validatedData = $request->validate([
            'rumah_ibadah'                  => 'required',
            'nama_pemohon'                  => 'required',
            'nomor_telepon_pemohon'         => 'required',
            'nama_ketua'                    => 'required',
            'nomor_telepon_ketua'           => 'required',
            'tahun_berdiri'                 => 'required',
            'nama_rumah_ibadah'             => 'required',
            'nomor_telepon_rumah_ibadah'    => 'required',
            'alamat_rumah_ibadah'           => 'required',
            'kecamatan'                     => 'required',
            'kelurahan'                     => 'required',
            'luas_tanah'                    => 'required',
            'luas_bangunan'                 => 'required',
            'nomor_telepon_rumah_ibadah'    => 'required',
            'foto'                          => 'required',
            'dokumen_lampiran'              => 'required'
        ]);

        DB::transaction(function () use ($validatedData) {
            $permohonan = Permohonan::create([
                'tanggal_waktu_permohonan' => Carbon::now('Asia/Kuala_Lumpur')->format("Y-m-d H:i:s")
            ]);


            $permohonanPendaftaranRumahIbadah = PermohonanPendaftaranRumahIbadah::create([
                'id_permohonan'                 => $permohonan->id,
                'id_rumah_ibadah'               => $validatedData['rumah_ibadah'],
                'nama_ketua'                    => $validatedData['nama_ketua'],
                'nomor_telepon_ketua'           => $validatedData['nomor_telepon_ketua'],
                'nama_rumah_ibadah'             => $validatedData['nama_rumah_ibadah'],
                'nomor_telepon_rumah_ibadah'    => $validatedData['nomor_telepon_ketua'],
                'alamat_rumah_ibadah'           => $validatedData['alamat_rumah_ibadah'],
                'tahun_berdiri'                 => $validatedData['tahun_berdiri'],
                'kecamatan'                     => $validatedData['kecamatan'],
                'kelurahan'                     => $validatedData['kelurahan'],
                'luas_tanah'                    => $validatedData['luas_tanah'],
                'luas_bangunan'                 => $validatedData['luas_bangunan'],
            ]);

            foreach ($validatedData['foto'] as $foto) {
                $uploadFile = UploadFile::where('nama_file', $foto)->first();
                $file = new File(Storage::path($foto));
                $newFilename = now()->timestamp . '-' . Str::random(20) . '.' . $file->getExtension();
                Storage::putFileAs(
                    'public/permohonan-rumah-ibadah/foto',
                    $file,
                    $newFilename
                );
                PermohonanPendaftaranRumahIbadahGambar::create([
                    'id_permohonan_pendaftaran_rumah_ibadah' => $permohonanPendaftaranRumahIbadah->id,
                    'nama_file'      => 'permohonan-rumah-ibadah/foto/' . $newFilename,
                    'nama_file_asli' => $uploadFile->nama_file_asli
                ]);
                $uploadFile->delete();
            }

            foreach ($validatedData['dokumen_lampiran'] as $dokumenLampiran) {
                $uploadFile = UploadFile::where('nama_file', $dokumenLampiran)->first();
                $file = new File(Storage::path($dokumenLampiran));
                $newFilename = now()->timestamp . '-' . Str::random(20) . '.' . $file->getExtension();
                Storage::putFileAs(
                    'public/permohonan-rumah-ibadah/dokumen-lampiran',
                    $file,
                    $newFilename
                );
                PermohonanPendaftaranRumahIbadahDokumenLampiran::create([
                    'id_permohonan_pendaftaran_rumah_ibadah' => $permohonanPendaftaranRumahIbadah->id,
                    'nama_file'      => 'permohonan-rumah-ibadah/dokumen-lampiran/' . $newFilename,
                    'nama_file_asli' => $uploadFile->nama_file_asli
                ]);
                $uploadFile->delete();
            }

            Pemohon::create([
                'id_permohonan' => $permohonan->id,
                'nama'          => $validatedData['nama_pemohon'],
                'nomor_telepon' => $validatedData['nomor_telepon_pemohon']
            ]);
        });

        return redirect('/permohonan-pendaftaran-rumah-ibadah')->with('success', 'Berhasil mengajukan permohonan pendaftaran rumah ibadah.');
    }

    public function riset()
    {
        return view('permohonan.riset');
    }

    public function storeRiset(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pemohon'          => 'required',
            'nomor_telepon_pemohon' => 'required',
            'asal_instansi'         => 'required',
            'keperluan'             => 'required',
            'tanggal_mulai'         => 'required',
            'tanggal_selesai'       => 'required'
        ]);

        DB::transaction(function () use ($validatedData) {
            $permohonan = Permohonan::create([
                'tanggal_waktu_permohonan' => Carbon::now('Asia/Kuala_Lumpur')->format("Y-m-d H:i:s")
            ]);


            PermohonanRiset::create([
                'id_permohonan'     => $permohonan->id,
                'asal_instansi'     => $validatedData['asal_instansi'],
                'keperluan'         => $validatedData['keperluan'],
                'tanggal_mulai'     => $validatedData['tanggal_mulai'],
                'tanggal_selesai'   => $validatedData['tanggal_selesai']
            ]);

            Pemohon::create([
                'id_permohonan' => $permohonan->id,
                'nama'          => $validatedData['nama_pemohon'],
                'nomor_telepon' => $validatedData['nomor_telepon_pemohon']
            ]);
        });

        return redirect('/permohonan-riset')->with('success', 'Berhasil mengajukan permohonan pendaftaran rumah ibadah.');
    }
}
