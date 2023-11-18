<?php

namespace App\Http\Controllers\Permohonan;

use App\Enums\Permohonan\PermohonanStatus;
use App\Http\Controllers\Controller;
use App\Models\Permohonan\Permohonan;
use App\Models\Permohonan\PermohonanTerverifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PermohonanMagangPKLController extends Controller
{
    public function index()
    {
        $permohonan = Permohonan::with(['pemohon', 'magangPKL', 'permohonanTerverifikasi'])
            ->whereHas('magangPKL')
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
        return view('dashboard.permohonan.magang-pkl.index', compact('permohonan'));
    }

    public function show(Permohonan $permohonan)
    {
        $permohonan = [
            'id'                        => $permohonan->id,
            'nama_pemohon'              => $permohonan->pemohon->nama,
            'nomor_telepon_pemohon'     => $permohonan->pemohon->nomor_telepon,
            'tanggal_permohonan'        => $permohonan->tanggalPermohonanFormatIndonesia(),
            'nama'                      => $permohonan->magangPKL->nama,
            'asal_sekolah'              => $permohonan->magangPKL->asal_sekolah,
            'alamat_sekolah'            => $permohonan->magangPKL->alamat_sekolah,
            'tanggal_mulai'             => $permohonan->magangPKL->tanggalMulaiFormatIndonesia(),
            'tanggal_selesai'           => $permohonan->magangPKL->tanggalSelesaiFormatIndonesia(),
            'status'                    => is_null($permohonan->permohonanTerverifikasi) ? null : $permohonan->permohonanTerverifikasi->status,
            'keterangan'                => $permohonan->permohonanTerverifikasi->keterangan ?? ''
        ];

        return view('dashboard.permohonan.magang-pkl.show', compact('permohonan'));
    }

    public function terima(Request $request, Permohonan $permohonan)
    {
        PermohonanTerverifikasi::create([
            'id_permohonan'      => $permohonan->id,
            'id_pengguna'        => auth()->user()->id,
            'tanggal_verifikasi' => Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d'),
            'keterangan'         => $request->get('keterangan_diterima'),
            'status'             => PermohonanStatus::DISETUJUI
        ]);

        Http::post(config('services.green_api.base_url') . '/waInstance' . config('services.green_api.id_instance') . '/sendMessage/' . config('services.green_api.api_token_instance'), [
            'chatId'    => $permohonan->pemohon->greenAPIPhoneNumber(),
            'message'   => $request->get('keterangan_diterima')
        ]);

        return redirect('/' . auth()->user()->status->route() . '/permohonan-magang-pkl/' . $permohonan->id)->with('success', 'Berhasil menerima permohonan.');
    }

    public function tolak(Request $request, Permohonan $permohonan)
    {
        PermohonanTerverifikasi::create([
            'id_permohonan'      => $permohonan->id,
            'id_pengguna'        => auth()->user()->id,
            'tanggal_verifikasi' => Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d'),
            'keterangan'         => $request->get('keterangan_ditolak'),
            'status'             => PermohonanStatus::DITOLAK
        ]);

        Http::post(config('services.green_api.base_url') . '/waInstance' . config('services.green_api.id_instance') . '/sendMessage/' . config('services.green_api.api_token_instance'), [
            'chatId'    => $permohonan->pemohon->greenAPIPhoneNumber(),
            'message'   => $request->get('keterangan_ditolak')
        ]);

        return redirect('/' . auth()->user()->status->route() . '/permohonan-magang-pkl/' . $permohonan->id)->with('success', 'Berhasil menolak permohonan.');
    }
}
