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

    public function laporan(Request $request)
    {
        $today = Carbon::now('Asia/Kuala_Lumpur')->locale('ID');
        $filter = [
            'today' => $today->day . ' ' . $today->getTranslatedMonthName() . ' ' . $today->year
        ];

        $permohonan = Permohonan::with(['pemohon', 'ukurKiblat', 'permohonanTerverifikasi'])
            ->whereHas('ukurKiblat')
            ->orderBy('tanggal_waktu_permohonan', 'DESC');

        if ($request->get('dari_tanggal') && $request->get('sampai_tanggal')) {
            $permohonan = $permohonan
                ->whereBetween('tanggal_waktu_permohonan', [
                    $request->get('dari_tanggal'),
                    $request->get('sampai_tanggal')
                ]);


            $dariTanggal = Carbon::createFromDate($request->get('dari_tanggal'))->locale('ID');
            $sampaiTanggal = Carbon::createFromDate($request->get('sampai_tanggal'))->locale('ID');
            $filter['dari_tanggal']    = $dariTanggal->day . ' ' . $dariTanggal->getTranslatedMonthName() . ' ' . $dariTanggal->year;
            $filter['sampai_tanggal']  = $sampaiTanggal->day . ' ' . $sampaiTanggal->getTranslatedMonthName() . ' ' . $sampaiTanggal->year;
        }

        if ($request->get('status')) {
            $filter['status'] = $request->get('status');
            if ($request->get('status') == 'Permohonan Baru') {
                $permohonan = $permohonan->doesntHave('permohonanTerverifikasi');
            } else {
                $permohonan = $permohonan->whereHas('permohonanTerverifikasi', function ($query) use ($request) {
                    $query->where('status', $request->get('status'));
                });
            }
        }

        $permohonan = $permohonan->get()
            ->map(function ($item) {
                return [
                    'id'                    => $item->id,
                    'nama'                  => $item->pemohon->nama,
                    'nomor_telepon'         => $item->pemohon->nomor_telepon,
                    'nama_ketua'            => $item->ukurKiblat->nama_ketua,
                    'nomor_telepon_ketua'   => $item->ukurKiblat->nomor_telepon_ketua,
                    'nama_rumah_ibadah'     => $item->ukurKiblat->nama_rumah_ibadah,
                    'status'                => is_null($item->permohonanTerverifikasi) ? null : $item->permohonanTerverifikasi->status
                ];
            });

        if ($request->get('print'))
            return view('dashboard.permohonan.ukur-kiblat.cetak', compact('permohonan', 'filter'));

        return view('dashboard.permohonan.ukur-kiblat.laporan', compact('permohonan', 'filter'));
    }
}
