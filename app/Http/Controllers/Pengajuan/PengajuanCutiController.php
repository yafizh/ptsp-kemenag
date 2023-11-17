<?php

namespace App\Http\Controllers\Pengajuan;

use App\Enums\Pengajuan\PengajuanStatus;
use App\Enums\User\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Master\JenisCuti;
use App\Models\Pengajuan\JenisPengajuan\PengajuanCuti;
use App\Models\Pengajuan\Pengajuan;
use App\Models\Pengajuan\PengajuanTerverifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanCutiController extends Controller
{
    public function index()
    {
        $pengajuan = Pengajuan::with([
            'pengajuanCuti.jenisCuti',
            'pengguna.pegawai'
        ])
            ->whereHas('pengajuanCuti')
            ->orderBy('tanggal_waktu_pengajuan', 'DESC');

        if (auth()->user()->status == UserStatus::PEGAWAI)
            $pengajuan = $pengajuan->where('id_pengguna', auth()->user()->id);

        $pengajuan = $pengajuan->get()->map(function ($item) {
            return [
                'id'                => $item->id,
                'nip'               => $item->pengguna->pegawai->nip,
                'nama'              => $item->pengguna->pegawai->nama,
                'tanggal_pengajuan' => $item->tanggalPengajuanFormatIndonesia(),
                'jenis_cuti'        => $item->pengajuanCuti->jenisCuti->nama,
                'status'            => is_null($item->pengajuanTerverifikasi) ? null : $item->pengajuanTerverifikasi->status
            ];
        });

        if (auth()->user()->status == UserStatus::PEGAWAI)
            return view('dashboard.pengajuan.cuti.index-pegawai', compact('pengajuan'));

        return view('dashboard.pengajuan.cuti.index', compact('pengajuan'));
    }

    public function create()
    {
        $jenisCuti = JenisCuti::orderBy('nama')->get();

        return view('dashboard.pengajuan.cuti.create', compact('jenisCuti'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_cuti'      => 'required',
            'tanggal_mulai'   => 'required',
            'tanggal_selesai' => 'required'
        ]);

        DB::transaction(function () use ($validatedData) {
            $pengajuan = Pengajuan::create([
                'id_pengguna'               => auth()->user()->id,
                'tanggal_waktu_pengajuan'   => Carbon::now('Asia/Kuala_Lumpur')->format("Y-m-d H:i:s")
            ]);

            PengajuanCuti::create([
                'id_pengajuan'    => $pengajuan->id,
                'id_jenis_cuti'   => $validatedData['jenis_cuti'],
                'tanggal_mulai'   => $validatedData['tanggal_mulai'],
                'tanggal_selesai' => $validatedData['tanggal_selesai']
            ]);
        });

        return redirect(auth()->user()->status->route() . '/pengajuan-cuti')->with('success', 'Berhasil mengajukan cuti.');
    }

    public function show(Pengajuan $pengajuan)
    {
        $pengajuan = [
            'id'                 => $pengajuan->id,
            'nip'                => $pengajuan->pengguna->pegawai->nip,
            'nama'               => $pengajuan->pengguna->pegawai->nama,
            'tanggal_pengajuan'  => $pengajuan->tanggalPengajuanFormatIndonesia(),
            'tanggal_verifikasi' => is_null($pengajuan->pengajuanTerverifikasi) ? '' : $pengajuan->pengajuanTerverifikasi->tanggalVerifikasiFormatIndoensia(),
            'jenis_cuti'         => $pengajuan->pengajuanCuti->jenisCuti->nama,
            'tanggal_mulai'      => $pengajuan->pengajuanCuti->tanggalMulaiFormatIndonesia(),
            'tanggal_selesai'    => $pengajuan->pengajuanCuti->tanggalSelesaiFormatIndonesia(),
            'status'             => is_null($pengajuan->pengajuanTerverifikasi) ? null : $pengajuan->pengajuanTerverifikasi->status,
            'keterangan'         => $pengajuan->pengajuanTerverifikasi->keterangan ?? ''
        ];

        if (auth()->user()->status == UserStatus::PEGAWAI)
            return view('dashboard.pengajuan.cuti.show-pegawai', compact('pengajuan'));

        return view('dashboard.pengajuan.cuti.show', compact('pengajuan'));
    }

    public function edit(Pengajuan $pengajuan)
    {
        $jenisCuti = JenisCuti::orderBy('nama')->get();
        $pengajuan = [
            'id'                => $pengajuan->id,
            'jenis_cuti'        => $pengajuan->pengajuanCuti->id_jenis_cuti,
            'tanggal_mulai'     => $pengajuan->pengajuanCuti->tanggal_mulai,
            'tanggal_selesai'   => $pengajuan->pengajuanCuti->tanggal_selesai
        ];

        return view('dashboard.pengajuan.cuti.edit', compact('pengajuan', 'jenisCuti'));
    }

    public function update(Request $request, Pengajuan $pengajuan)
    {
        $validatedData = $request->validate([
            'jenis_cuti'      => 'required',
            'tanggal_mulai'   => 'required',
            'tanggal_selesai' => 'required'
        ]);

        $pengajuan->pengajuanCuti->update([
            'id_jenis_cuti'   => $validatedData['jenis_cuti'],
            'tanggal_mulai'   => $validatedData['tanggal_mulai'],
            'tanggal_selesai' => $validatedData['tanggal_selesai']
        ]);

        return redirect(auth()->user()->status->route() . '/pengajuan-cuti')->with('success', 'Berhasil memperbaharui pengajuan cuti.');
    }

    public function destroy(Pengajuan $pengajuan)
    {
        $pengajuan->pengajuanCuti->delete();
        $pengajuan->delete();
        return redirect(auth()->user()->status->route() . '/pengajuan-cuti')->with('success', 'Berhasil menghapus pengajuan cuti.');
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

        return redirect('/' . auth()->user()->status->route() . '/pengajuan-cuti/' . $pengajuan->id)->with('success', 'Berhasil menerima pengajuan.');
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

        return redirect('/' . auth()->user()->status->route() . '/pengajuan-cuti/' . $pengajuan->id)->with('success', 'Berhasil menolak pengajuan.');
    }
}
