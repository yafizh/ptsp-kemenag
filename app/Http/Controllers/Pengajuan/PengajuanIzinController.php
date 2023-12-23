<?php

namespace App\Http\Controllers\Pengajuan;

use App\Enums\Pengajuan\PengajuanStatus;
use App\Enums\User\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Master\JenisIzin;
use App\Models\Pengajuan\JenisPengajuan\PengajuanIzin;
use App\Models\Pengajuan\Pengajuan;
use App\Models\Pengajuan\PengajuanTerverifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanIzinController extends Controller
{
    public function index()
    {
        $pengajuan = Pengajuan::with([
            'pengajuanIzin.jenisIzin',
            'pengguna.pegawai'
        ])
            ->whereHas('pengajuanIzin')
            ->orderBy('tanggal_waktu_pengajuan', 'DESC');

        if (auth()->user()->status == UserStatus::PEGAWAI)
            $pengajuan = $pengajuan->where('id_pengguna', auth()->user()->id);

        $pengajuan = $pengajuan->get()->map(function ($item) {
            return [
                'id'                => $item->id,
                'nip'               => $item->pengguna->pegawai->nip,
                'nama'              => $item->pengguna->pegawai->nama,
                'tanggal_pengajuan' => $item->tanggalPengajuanFormatIndonesia(),
                'jenis_izin'        => $item->pengajuanIzin->jenisIzin->nama,
                'status'            => is_null($item->pengajuanTerverifikasi) ? null : $item->pengajuanTerverifikasi->status
            ];
        });

        if (auth()->user()->status == UserStatus::PEGAWAI)
            return view('dashboard.pengajuan.izin.index-pegawai', compact('pengajuan'));

        return view('dashboard.pengajuan.izin.index', compact('pengajuan'));
    }

    public function create()
    {
        $jenisIzin = JenisIzin::orderBy('nama')->get();

        return view('dashboard.pengajuan.izin.create', compact('jenisIzin'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_izin'      => 'required',
            'tanggal_mulai'   => 'required',
            'tanggal_selesai' => 'required',
            'keterangan'      => 'required'
        ]);

        DB::transaction(function () use ($validatedData) {
            $pengajuan = Pengajuan::create([
                'id_pengguna'               => auth()->user()->id,
                'tanggal_waktu_pengajuan'   => Carbon::now('Asia/Kuala_Lumpur')->format("Y-m-d H:i:s")
            ]);

            PengajuanIzin::create([
                'id_pengajuan'    => $pengajuan->id,
                'id_jenis_izin'   => $validatedData['jenis_izin'],
                'tanggal_mulai'   => $validatedData['tanggal_mulai'],
                'tanggal_selesai' => $validatedData['tanggal_selesai'],
                'keterangan'      => $validatedData['keterangan']
            ]);
        });

        return redirect(auth()->user()->status->route() . '/pengajuan-izin')->with('success', 'Berhasil mengajukan izin.');
    }

    public function show(Pengajuan $pengajuan)
    {
        $pengajuan = [
            'id'                    => $pengajuan->id,
            'nip'                   => $pengajuan->pengguna->pegawai->nip,
            'nama'                  => $pengajuan->pengguna->pegawai->nama,
            'tanggal_pengajuan'     => $pengajuan->tanggalPengajuanFormatIndonesia(),
            'tanggal_verifikasi'    => is_null($pengajuan->pengajuanTerverifikasi) ? '' : $pengajuan->pengajuanTerverifikasi->tanggalVerifikasiFormatIndoensia(),
            'jenis_izin'            => $pengajuan->pengajuanIzin->jenisIzin->nama,
            'tanggal_mulai'         => $pengajuan->pengajuanIzin->tanggalMulaiFormatIndonesia(),
            'tanggal_selesai'       => $pengajuan->pengajuanIzin->tanggalSelesaiFormatIndonesia(),
            'keterangan_izin'       => $pengajuan->pengajuanIzin->keterangan,
            'status'                => is_null($pengajuan->pengajuanTerverifikasi) ? null : $pengajuan->pengajuanTerverifikasi->status,
            'keterangan_verifikasi' => $pengajuan->pengajuanTerverifikasi->keterangan ?? ''
        ];

        if (auth()->user()->status == UserStatus::PEGAWAI)
            return view('dashboard.pengajuan.izin.show-pegawai', compact('pengajuan'));

        return view('dashboard.pengajuan.izin.show', compact('pengajuan'));
    }

    public function edit(Pengajuan $pengajuan)
    {
        $jenisIzin = JenisIzin::orderBy('nama')->get();
        $pengajuan = [
            'id'                => $pengajuan->id,
            'jenis_izin'        => $pengajuan->pengajuanIzin->id_jenis_izin,
            'tanggal_mulai'     => $pengajuan->pengajuanIzin->tanggal_mulai,
            'tanggal_selesai'   => $pengajuan->pengajuanIzin->tanggal_selesai,
            'keterangan'        => $pengajuan->pengajuanIzin->keterangan
        ];

        return view('dashboard.pengajuan.izin.edit', compact('pengajuan', 'jenisIzin'));
    }

    public function update(Request $request, Pengajuan $pengajuan)
    {
        $validatedData = $request->validate([
            'jenis_izin'      => 'required',
            'tanggal_mulai'   => 'required',
            'tanggal_selesai' => 'required',
            'keterangan'      => 'required'
        ]);

        $pengajuan->pengajuanIzin->update([
            'id_jenis_izin'   => $validatedData['jenis_izin'],
            'tanggal_mulai'   => $validatedData['tanggal_mulai'],
            'tanggal_selesai' => $validatedData['tanggal_selesai'],
            'keterangan'      => $validatedData['keterangan']
        ]);

        return redirect(auth()->user()->status->route() . '/pengajuan-izin')->with('success', 'Berhasil memperbaharui pengajuan izin.');
    }

    public function destroy(Pengajuan $pengajuan)
    {
        $pengajuan->pengajuanIzin->delete();
        $pengajuan->delete();
        return redirect(auth()->user()->status->route() . '/pengajuan-izin')->with('success', 'Berhasil menghapus pengajuan izin.');
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

        return redirect('/' . auth()->user()->status->route() . '/pengajuan-izin/' . $pengajuan->id)->with('success', 'Berhasil menerima pengajuan.');
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

        return redirect('/' . auth()->user()->status->route() . '/pengajuan-izin/' . $pengajuan->id)->with('success', 'Berhasil menolak pengajuan.');
    }

    public function laporan(Request $request)
    {
        $jenisIzin = JenisIzin::orderBy('nama')->get();
        $today = Carbon::now('Asia/Kuala_Lumpur')->locale('ID');
        $filter = [
            'today' => $today->day . ' ' . $today->getTranslatedMonthName() . ' ' . $today->year
        ];

        $pengajuan = Pengajuan::with([
            'pengguna.pegawai',
            'pengajuanIzin.jenisIzin',
            'pengajuanTerverifikasi'
        ])
            ->whereHas('pengajuanIzin')
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

        if ($request->get('jenis_izin')) {
            $pengajuan = $pengajuan->whereHas('pengajuanIzin', function ($query) use ($request) {
                $query->where('id_jenis_izin', $request->get('jenis_izin'));
            });
            $filter['jenis_izin'] = JenisIzin::where('id', $request->get('jenis_izin'))->first()->nama;
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
                    'jenis_izin'        => $item->pengajuanIzin->jenisIzin->nama,
                    'status'            => is_null($item->pengajuanTerverifikasi) ? null : $item->pengajuanTerverifikasi->status
                ];
            });

        if ($request->get('print'))
            return view('dashboard.pengajuan.izin.cetak', compact('pengajuan', 'filter'));

        return view('dashboard.pengajuan.izin.laporan', compact('pengajuan', 'filter', 'jenisIzin'));
    }
}
