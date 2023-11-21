<?php

namespace App\Http\Controllers\Pengajuan;

use App\Enums\Pengajuan\PengajuanStatus;
use App\Enums\User\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Master\JenisKendaraan;
use App\Models\Pengajuan\JenisPengajuan\PengajuanSPDP;
use App\Models\Pengajuan\Pengajuan;
use App\Models\Pengajuan\PengajuanTerverifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanSPDPController extends Controller
{
    public function index()
    {
        $pengajuan = Pengajuan::with([
            'pengajuanSPDP',
            'pengguna.pegawai'
        ])
            ->whereHas('pengajuanSPDP')
            ->orderBy('tanggal_waktu_pengajuan', 'DESC');

        if (auth()->user()->status == UserStatus::PEGAWAI)
            $pengajuan = $pengajuan->where('id_pengguna', auth()->user()->id);

        $pengajuan = $pengajuan->get()->map(function ($item) {
            return [
                'id'                => $item->id,
                'nip'               => $item->pengguna->pegawai->nip,
                'nama'              => $item->pengguna->pegawai->nama,
                'tanggal_pengajuan' => $item->tanggalPengajuanFormatIndonesia(),
                'tujuan'            => $item->pengajuanSPDP->tujuan,
                'status'            => is_null($item->pengajuanTerverifikasi) ? null : $item->pengajuanTerverifikasi->status
            ];
        });

        if (auth()->user()->status == UserStatus::PEGAWAI)
            return view('dashboard.pengajuan.spdp.index-pegawai', compact('pengajuan'));

        return view('dashboard.pengajuan.spdp.index', compact('pengajuan'));
    }

    public function create()
    {
        $jenisKendaraan = JenisKendaraan::orderBy('nama')->get();

        return view('dashboard.pengajuan.spdp.create', compact('jenisKendaraan'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_kendaraan'   => 'required',
            'tanggal_berangkat' => 'required',
            'tanggal_kembali'   => 'required',
            'tujuan'            => 'required',
            'keterangan'        => 'required'
        ]);

        DB::transaction(function () use ($validatedData) {
            $pengajuan = Pengajuan::create([
                'id_pengguna'               => auth()->user()->id,
                'tanggal_waktu_pengajuan'   => Carbon::now('Asia/Kuala_Lumpur')->format("Y-m-d H:i:s")
            ]);

            PengajuanSPDP::create([
                'id_pengajuan'       => $pengajuan->id,
                'id_jenis_kendaraan' => $validatedData['jenis_kendaraan'],
                'tanggal_berangkat'  => $validatedData['tanggal_berangkat'],
                'tanggal_kembali'    => $validatedData['tanggal_kembali'],
                'tujuan'             => $validatedData['tujuan'],
                'keterangan'         => $validatedData['keterangan'],
            ]);
        });

        return redirect(auth()->user()->status->route() . '/pengajuan-spdp')->with('success', 'Berhasil mengajukan SPDP.');
    }

    public function show(Pengajuan $pengajuan)
    {
        $pengajuan = [
            'id'                    => $pengajuan->id,
            'nip'                   => $pengajuan->pengguna->pegawai->nip,
            'nama'                  => $pengajuan->pengguna->pegawai->nama,
            'tanggal_pengajuan'     => $pengajuan->tanggalPengajuanFormatIndonesia(),
            'tanggal_verifikasi'    => is_null($pengajuan->pengajuanTerverifikasi) ? '' : $pengajuan->pengajuanTerverifikasi->tanggalVerifikasiFormatIndoensia(),
            'jenis_kendaraan'       => $pengajuan->pengajuanSPDP->jenisKendaraan->nama,
            'tanggal_berangkat'     => $pengajuan->pengajuanSPDP->tanggalBerangkatFormatIndonesia(),
            'tanggal_kembali'       => $pengajuan->pengajuanSPDP->tanggalKembaliFormatIndonesia(),
            'tujuan'                => $pengajuan->pengajuanSPDP->tujuan,
            'keterangan_spdp'       => $pengajuan->pengajuanSPDP->keterangan,
            'status'                => is_null($pengajuan->pengajuanTerverifikasi) ? null : $pengajuan->pengajuanTerverifikasi->status,
            'keterangan_verifikasi' => $pengajuan->pengajuanTerverifikasi->keterangan ?? ''
        ];

        if (auth()->user()->status == UserStatus::PEGAWAI)
            return view('dashboard.pengajuan.spdp.show-pegawai', compact('pengajuan'));

        return view('dashboard.pengajuan.spdp.show', compact('pengajuan'));
    }

    public function edit(Pengajuan $pengajuan)
    {
        $jenisKendaraan = JenisKendaraan::orderBy('nama')->get();
        $pengajuan = [
            'id'                => $pengajuan->id,
            'jenis_kendaraan'   => $pengajuan->pengajuanSPDP->id_jenis_kendaraan,
            'tanggal_berangkat' => $pengajuan->pengajuanSPDP->tanggal_berangkat,
            'tanggal_kembali'   => $pengajuan->pengajuanSPDP->tanggal_kembali,
            'tujuan'            => $pengajuan->pengajuanSPDP->tujuan,
            'keterangan'        => $pengajuan->pengajuanSPDP->keterangan
        ];

        return view('dashboard.pengajuan.spdp.edit', compact('pengajuan', 'jenisKendaraan'));
    }

    public function update(Request $request, Pengajuan $pengajuan)
    {
        $validatedData = $request->validate([
            'jenis_kendaraan'   => 'required',
            'tanggal_berangkat' => 'required',
            'tanggal_kembali'   => 'required',
            'tujuan'            => 'required',
            'keterangan'        => 'required'
        ]);

        $pengajuan->pengajuanSPDP->update([
            'id_jenis_kendaraan'    => $validatedData['jenis_kendaraan'],
            'tanggal_berangkat'     => $validatedData['tanggal_berangkat'],
            'tanggal_kembali'       => $validatedData['tanggal_kembali'],
            'tujuan'                => $validatedData['tujuan'],
            'keterangan'            => $validatedData['keterangan']
        ]);

        return redirect(auth()->user()->status->route() . '/pengajuan-spdp')->with('success', 'Berhasil memperbaharui pengajuan SPDP.');
    }

    public function destroy(Pengajuan $pengajuan)
    {
        $pengajuan->pengajuanSPDP->delete();
        $pengajuan->delete();
        return redirect(auth()->user()->status->route() . '/pengajuan-spdp')->with('success', 'Berhasil menghapus pengajuan SPDP.');
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

        return redirect('/' . auth()->user()->status->route() . '/pengajuan-spdp/' . $pengajuan->id)->with('success', 'Berhasil menerima pengajuan.');
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

        return redirect('/' . auth()->user()->status->route() . '/pengajuan-spdp/' . $pengajuan->id)->with('success', 'Berhasil menolak pengajuan.');
    }

    public function laporan(Request $request)
    {
        $jenisKendaraan = JenisKendaraan::orderBy('nama')->get();
        $today = Carbon::now('Asia/Kuala_Lumpur')->locale('ID');
        $filter = [
            'today' => $today->day . ' ' . $today->getTranslatedMonthName() . ' ' . $today->year
        ];

        $pengajuan = Pengajuan::with([
            'pengguna.pegawai',
            'pengajuanSPDP.jenisKendaraan',
            'pengajuanTerverifikasi'
        ])
            ->whereHas('pengajuanSPDP')
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

        if ($request->get('jenis_kendaraan')) {
            $pengajuan = $pengajuan->whereHas('pengajuanSPDP', function ($query) use ($request) {
                $query->where('id_jenis_kendaraan', $request->get('jenis_kendaraan'));
            });
            $filter['jenis_kendaraan'] = JenisKendaraan::where('id', $request->get('jenis_kendaraan'))->first()->nama;
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
                    'jenis_kendaraan'   => $item->pengajuanSPDP->jenisKendaraan->nama,
                    'status'            => is_null($item->pengajuanTerverifikasi) ? null : $item->pengajuanTerverifikasi->status
                ];
            });

        if ($request->get('print'))
            return view('dashboard.pengajuan.spdp.cetak', compact('pengajuan', 'filter'));

        return view('dashboard.pengajuan.spdp.laporan', compact('pengajuan', 'filter', 'jenisKendaraan'));
    }

    public function spdp()
    {
        return view('dashboard.pengajuan.spdp.spdp');
    }
}
