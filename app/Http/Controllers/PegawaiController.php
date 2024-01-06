<?php

namespace App\Http\Controllers;

use App\Models\Master\Golongan;
use App\Models\Master\Jabatan;
use App\Models\Master\Pangkat;
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
        $jabatan = Jabatan::orderBy('nama')->get();
        $golongan = Golongan::orderBy('nama')->get();
        $pangkat = Pangkat::orderBy('nama')->get();

        return view('dashboard.pegawai.create', compact('jabatan', 'golongan', 'pangkat'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'status_user'           => 'required',
            'nip'                   => 'required',
            'nama'                  => 'required',
            'jabatan'               => 'required',
            'golongan'              => 'required',
            'pangkat'               => 'required',
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
                'username'  => $validatedData['nip'],
                'password'  => $validatedData['nip'],
                'status'    => $validatedData['status_user']
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
                'id_jabatan'            => $validatedData['jabatan'],
                'id_golongan'           => $validatedData['golongan'],
                'id_pangkat'            => $validatedData['pangkat'],
                'nip'                   => $validatedData['nip'],
                'nama'                  => $validatedData['nama'],
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
        $jabatan = Jabatan::orderBy('nama')->get();
        $golongan = Golongan::orderBy('nama')->get();
        $pangkat = Pangkat::orderBy('nama')->get();

        return view('dashboard.pegawai.edit', compact('pegawai', 'jabatan', 'golongan', 'pangkat'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $validatedData = $request->validate([
            'status_user'           => 'required',
            'nip'                   => 'required',
            'nama'                  => 'required',
            'jabatan'               => 'required',
            'pangkat'               => 'required',
            'golongan'              => 'required',
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
                'status'   => $validatedData['status_user']
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
                'id_jabatan'            => $validatedData['jabatan'],
                'id_golongan'           => $validatedData['golongan'],
                'id_pangkat'            => $validatedData['pangkat'],
                'nip'                   => $validatedData['nip'],
                'nama'                  => $validatedData['nama'],
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
