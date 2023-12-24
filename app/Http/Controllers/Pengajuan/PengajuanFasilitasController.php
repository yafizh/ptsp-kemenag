<?php

namespace App\Http\Controllers\Pengajuan;

use App\Enums\Pengajuan\PengajuanStatus;
use App\Enums\User\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Pengajuan\JenisPengajuan\PengajuanFasilitas;
use App\Models\Pengajuan\Pengajuan;
use App\Models\Pengajuan\PengajuanTerverifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanFasilitasController extends Controller
{
    public function index()
    {
        $pengajuan = Pengajuan::with([
            'pengajuanFasilitas',
            'pengguna.pegawai'
        ])
            ->whereHas('pengajuanFasilitas')
            ->orderBy('tanggal_waktu_pengajuan', 'DESC');

        if (auth()->user()->status == UserStatus::PEGAWAI)
            $pengajuan = $pengajuan->where('id_pengguna', auth()->user()->id);

        $pengajuan = $pengajuan->get()->map(function ($item) {
            return [
                'id'                => $item->id,
                'nip'               => $item->pengguna->pegawai->nip,
                'nama'              => $item->pengguna->pegawai->nama,
                'tanggal_pengajuan' => $item->tanggalPengajuanFormatIndonesia(),
                'fasilitas'         => $item->pengajuanFasilitas->fasilitas,
                'status'            => is_null($item->pengajuanTerverifikasi) ? null : $item->pengajuanTerverifikasi->status
            ];
        });

        if (auth()->user()->status == UserStatus::PEGAWAI)
            return view('dashboard.pengajuan.fasilitas.index-pegawai', compact('pengajuan'));

        return view('dashboard.pengajuan.fasilitas.index', compact('pengajuan'));
    }

    public function create()
    {
        return view('dashboard.pengajuan.fasilitas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fasilitas' => 'required',
            'keperluan' => 'required'
        ]);

        DB::transaction(function () use ($validatedData) {
            $pengajuan = Pengajuan::create([
                'id_pengguna'               => auth()->user()->id,
                'tanggal_waktu_pengajuan'   => Carbon::now('Asia/Kuala_Lumpur')->format("Y-m-d H:i:s")
            ]);

            PengajuanFasilitas::create([
                'id_pengajuan'  => $pengajuan->id,
                'fasilitas'     => $validatedData['fasilitas'],
                'keperluan'     => $validatedData['keperluan']
            ]);
        });

        return redirect(auth()->user()->status->route() . '/pengajuan-fasilitas')->with('success', 'Berhasil mengajukan fasilitas.');
    }

    public function show(Pengajuan $pengajuan)
    {
        $pengajuan = [
            'id'                 => $pengajuan->id,
            'nip'                => $pengajuan->pengguna->pegawai->nip,
            'nama'               => $pengajuan->pengguna->pegawai->nama,
            'tanggal_pengajuan'  => $pengajuan->tanggalPengajuanFormatIndonesia(),
            'tanggal_verifikasi' => is_null($pengajuan->pengajuanTerverifikasi) ? '' : $pengajuan->pengajuanTerverifikasi->tanggalVerifikasiFormatIndoensia(),
            'fasilitas'          => $pengajuan->pengajuanFasilitas->fasilitas,
            'keperluan'          => $pengajuan->pengajuanFasilitas->keperluan,
            'status'             => is_null($pengajuan->pengajuanTerverifikasi) ? null : $pengajuan->pengajuanTerverifikasi->status,
            'keterangan'         => $pengajuan->pengajuanTerverifikasi->keterangan ?? ''
        ];

        if (auth()->user()->status == UserStatus::PEGAWAI)
            return view('dashboard.pengajuan.fasilitas.show-pegawai', compact('pengajuan'));

        return view('dashboard.pengajuan.fasilitas.show', compact('pengajuan'));
    }

    public function edit(Pengajuan $pengajuan)
    {
        $pengajuan = [
            'id'        => $pengajuan->id,
            'fasilitas' => $pengajuan->pengajuanFasilitas->fasilitas,
            'keperluan' => $pengajuan->pengajuanFasilitas->keperluan
        ];

        return view('dashboard.pengajuan.fasilitas.edit', compact('pengajuan'));
    }

    public function update(Request $request, Pengajuan $pengajuan)
    {
        $validatedData = $request->validate([
            'fasilitas' => 'required',
            'keperluan' => 'required'
        ]);

        $pengajuan->pengajuanFasilitas->update([
            'fasilitas' => $validatedData['fasilitas'],
            'keperluan' => $validatedData['keperluan']
        ]);

        return redirect(auth()->user()->status->route() . '/pengajuan-fasilitas')->with('success', 'Berhasil memperbaharui pengajuan fasilitas.');
    }

    public function destroy(Pengajuan $pengajuan)
    {
        $pengajuan->pengajuanFasilitas->delete();
        $pengajuan->delete();
        return redirect(auth()->user()->status->route() . '/pengajuan-fasilitas')->with('success', 'Berhasil menghapus pengajuan fasilitas.');
    }

    public function terima(Request $request, Pengajuan $pengajuan)
    {
        PengajuanTerverifikasi::create([
            'id_pengajuan'              => $pengajuan->id,
            'id_pengguna'               => auth()->user()->id,
            'tanggal_waktu_verifikasi'  => Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s'),
            'keterangan'                => $request->get('keterangan_diterima'),
            'status'                    => PengajuanStatus::DISETUJUI
        ]);

        return redirect('/' . auth()->user()->status->route() . '/pengajuan-fasilitas/' . $pengajuan->id)->with('success', 'Berhasil menerima pengajuan.');
    }

    public function tolak(Request $request, Pengajuan $pengajuan)
    {
        PengajuanTerverifikasi::create([
            'id_pengajuan'              => $pengajuan->id,
            'id_pengguna'               => auth()->user()->id,
            'tanggal_waktu_verifikasi'  => Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s'),
            'keterangan'                => $request->get('keterangan_ditolak'),
            'status'                    => PengajuanStatus::DITOLAK
        ]);

        return redirect('/' . auth()->user()->status->route() . '/pengajuan-fasilitas/' . $pengajuan->id)->with('success', 'Berhasil menolak pengajuan.');
    }

    public function laporan(Request $request)
    {
        $today = Carbon::now('Asia/Kuala_Lumpur')->locale('ID');
        $filter = [
            'today' => $today->day . ' ' . $today->getTranslatedMonthName() . ' ' . $today->year
        ];

        $pengajuan = Pengajuan::with([
            'pengguna.pegawai',
            'pengajuanFasilitas',
            'pengajuanTerverifikasi'
        ])
            ->whereHas('pengajuanFasilitas')
            ->orderBy('tanggal_waktu_pengajuan', 'DESC');

        if ($request->get('dari_tanggal') && $request->get('sampai_tanggal')) {
            $pengajuan = $pengajuan
                ->whereBetween('tanggal_waktu_pengajuan', [
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
            if ($request->get('status') == 'Pengajuan Baru') {
                $pengajuan = $pengajuan->doesntHave('pengajuanTerverifikasi');
            } else {
                $pengajuan = $pengajuan->whereHas('pengajuanTerverifikasi', function ($query) use ($request) {
                    $query->where('status', $request->get('status'));
                });
            }
        }

        $pengajuan = $pengajuan->get()
            ->map(function ($item) {
                return [
                    'tanggal_pengajuan' => $item->tanggalPengajuanFormatIndonesia(),
                    'nip'               => $item->pengguna->pegawai->nip,
                    'nama'              => $item->pengguna->pegawai->nama,
                    'fasilitas'         => $item->pengajuanFasilitas->fasilitas,
                    'status'            => is_null($item->pengajuanTerverifikasi) ? null : $item->pengajuanTerverifikasi->status
                ];
            });

        if ($request->get('print'))
            return view('dashboard.pengajuan.fasilitas.cetak', compact('pengajuan', 'filter'));

        return view('dashboard.pengajuan.fasilitas.laporan', compact('pengajuan', 'filter'));
    }
}
