<?php

namespace App\Http\Controllers\Permohonan;

use App\Enums\Permohonan\PermohonanStatus;
use App\Http\Controllers\Controller;
use App\Models\Permohonan\Permohonan;
use App\Models\Permohonan\PermohonanTerverifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PermohonanUkurKiblatController extends Controller
{
    public function index()
    {
        $permohonan = Permohonan::with(['pemohon', 'ukurKiblat', 'permohonanTerverifikasi'])
            ->whereHas('ukurKiblat')
            ->orderBy('tanggal_waktu_permohonan', 'DESC')
            ->get()
            ->map(function ($item) {
                return [
                    'id'            => $item->id,
                    'nama'          => $item->pemohon->nama,
                    'nomor_telepon' => $item->pemohon->nomor_telepon,
                    'status'        => is_null($item->permohonanTerverifikasi) ? null : $item->permohonanTerverifikasi->status
                ];
            });
        return view('dashboard.permohonan.ukur-kiblat.index', compact('permohonan'));
    }

    public function show(Permohonan $permohonan)
    {
        $permohonan = [
            'id'                         => $permohonan->id,
            'nama_pemohon'               => $permohonan->pemohon->nama,
            'nomor_telepon_pemohon'      => $permohonan->pemohon->nomor_telepon,
            'tanggal_permohonan'         => $permohonan->tanggalPermohonanFormatIndonesia(),
            'nama_ketua'                 => $permohonan->ukurKiblat->nama_ketua,
            'nomor_telepon_ketua'        => $permohonan->ukurKiblat->nomor_telepon_ketua,
            'nama_rumah_ibadah'          => $permohonan->ukurKiblat->nama_rumah_ibadah,
            'alamat_rumah_ibadah'        => $permohonan->ukurKiblat->alamat_rumah_ibadah,
            'nomor_telepon_rumah_ibadah' => $permohonan->ukurKiblat->nomor_telepon_rumah_ibadah,
            'status'                     => is_null($permohonan->permohonanTerverifikasi) ? null : $permohonan->permohonanTerverifikasi->status,
            'keterangan'                 => $permohonan->permohonanTerverifikasi->keterangan ?? ''
        ];

        return view('dashboard.permohonan.ukur-kiblat.show', compact('permohonan'));
    }

    public function terima(Request $request, Permohonan $permohonan)
    {
        PermohonanTerverifikasi::create([
            'id_permohonan'             => $permohonan->id,
            'id_pengguna'               => auth()->user()->id,
            'tanggal_waktu_verifikasi'  => Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s'),
            'keterangan'                => $request->get('keterangan_diterima'),
            'status'                    => PermohonanStatus::DISETUJUI
        ]);

        Http::post(config('services.green_api.base_url') . '/waInstance' . config('services.green_api.id_instance') . '/sendMessage/' . config('services.green_api.api_token_instance'), [
            'chatId'    => $permohonan->pemohon->greenAPIPhoneNumber(),
            'message'   => $request->get('keterangan_diterima')
        ]);

        return redirect('/' . auth()->user()->status->route() . '/permohonan-ukur-kiblat/' . $permohonan->id)->with('success', 'Berhasil menerima permohonan.');
    }

    public function tolak(Request $request, Permohonan $permohonan)
    {
        PermohonanTerverifikasi::create([
            'id_permohonan'             => $permohonan->id,
            'id_pengguna'               => auth()->user()->id,
            'tanggal_waktu_verifikasi'  => Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s'),
            'keterangan'                => $request->get('keterangan_ditolak'),
            'status'                    => PermohonanStatus::DITOLAK
        ]);

        Http::post(config('services.green_api.base_url') . '/waInstance' . config('services.green_api.id_instance') . '/sendMessage/' . config('services.green_api.api_token_instance'), [
            'chatId'    => $permohonan->pemohon->greenAPIPhoneNumber(),
            'message'   => $request->get('keterangan_ditolak')
        ]);

        return redirect('/' . auth()->user()->status->route() . '/permohonan-ukur-kiblat/' . $permohonan->id)->with('success', 'Berhasil menolak permohonan.');
    }
}
