<?php

namespace App\Http\Controllers;

use App\Models\Pegawai\Pegawai;
use App\Models\Pegawai\PegawaiFoto;
use App\Models\Pengguna;
use App\Models\UploadFile;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('dashboard.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('dashboard.pegawai.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip'                   => 'required',
            'nama'                  => 'required',
            'jabatan'               => 'required',
            'jenis_kelamin'         => 'required',
            'nomor_telepon'         => 'required',
            'pendidikan_terakhir'   => 'required',
            'tmt'                   => 'required',
            'tanggal_lahir'         => 'required',
            'alamat'                => 'required',
            'tempat_lahir'          => 'required',
            'foto'                  => 'required'
        ]);

        DB::transaction(function () use ($validatedData) {
            $pengguna = Pengguna::create([
                'username' => $validatedData['nip'],
                'password' => $validatedData['nip']
            ]);

            $uploadFile = UploadFile::where('nama_file', $validatedData['foto'])->first();
            $file = new File(Storage::path($validatedData['foto']));
            $namaFile = now()->timestamp . '-' . Str::random(20) . '.' . $file->getExtension();
            Storage::putFileAs(
                'public/pegawai',
                $file,
                $namaFile
            );

            $pegawai = Pegawai::create([
                'id_pengguna'           => $pengguna->id,
                'nip'                   => $validatedData['nip'],
                'nama'                  => $validatedData['nama'],
                'jabatan'               => $validatedData['jabatan'],
                'jenis_kelamin'         => $validatedData['jenis_kelamin'],
                'nomor_telepon'         => $validatedData['nomor_telepon'],
                'pendidikan_terakhir'   => $validatedData['pendidikan_terakhir'],
                'tmt'                   => $validatedData['tmt'],
                'tanggal_lahir'         => $validatedData['tanggal_lahir'],
                'alamat'                => $validatedData['alamat'],
                'tempat_lahir'          => $validatedData['tempat_lahir']
            ]);

            PegawaiFoto::create([
                'id_pegawai'        => $pegawai->id,
                'nama_file'         => 'pegawai/' . $namaFile,
                'nama_file_asli'    => $uploadFile->nama_file_asli
            ]);

            $uploadFile->delete();
        });

        return redirect('/' . auth()->user()->status->route() . '/pegawai')->with('success', 'Berhasil menambah pegawai.');
    }

    public function show(Pegawai $pegawai)
    {
        return view('dashboard.pegawai.show', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai)
    {
        return view('dashboard.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $validatedData = $request->validate([
            'nip'                   => 'required',
            'nama'                  => 'required',
            'jabatan'               => 'required',
            'jenis_kelamin'         => 'required',
            'nomor_telepon'         => 'required',
            'pendidikan_terakhir'   => 'required',
            'tmt'                   => 'required',
            'tanggal_lahir'         => 'required',
            'alamat'                => 'required',
            'tempat_lahir'          => 'required',
            'foto'                  => 'required'
        ]);

        DB::transaction(function () use ($validatedData, $pegawai) {
            $pegawai->pengguna->update([
                'username' => $validatedData['nip'],
            ]);

            if ($validatedData['foto'] != $pegawai->foto->nama_file) {
                $uploadFile = UploadFile::where('nama_file', $validatedData['foto'])->first();
                $file = new File(Storage::path($validatedData['foto']));
                $namaFile = now()->timestamp . '-' . Str::random(20) . '.' . $file->getExtension();
                Storage::putFileAs(
                    'public/pegawai',
                    $file,
                    $namaFile
                );

                $pegawai->foto->update([
                    'nama_file'         => 'pegawai/' . $namaFile,
                    'nama_file_asli'    => $uploadFile->nama_file_asli
                ]);

                $uploadFile->delete();
            }

            $pegawai->update([
                'nip'                   => $validatedData['nip'],
                'nama'                  => $validatedData['nama'],
                'jabatan'               => $validatedData['jabatan'],
                'jenis_kelamin'         => $validatedData['jenis_kelamin'],
                'nomor_telepon'         => $validatedData['nomor_telepon'],
                'pendidikan_terakhir'   => $validatedData['pendidikan_terakhir'],
                'tmt'                   => $validatedData['tmt'],
                'tanggal_lahir'         => $validatedData['tanggal_lahir'],
                'alamat'                => $validatedData['alamat'],
                'tempat_lahir'          => $validatedData['tempat_lahir']
            ]);
        });

        return redirect('/' . auth()->user()->status->route() . '/pegawai')->with('success', 'Berhasil memperbaharui pegawai.');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->pengguna->delete();
        $pegawai->foto->delete();
        $pegawai->delete();
        return redirect('/' . auth()->user()->status->route() . '/pegawai')->with('success', 'Berhasil menghapus pegawai.');
    }
}
