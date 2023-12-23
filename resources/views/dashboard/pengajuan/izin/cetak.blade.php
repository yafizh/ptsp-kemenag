@extends('dashboard.layouts.cetak')

@section('app-content')
    <h4 class="text-center my-3">Laporan Pengajuan Izin</h4>
    <section class="p-3">
        <strong>
            <span style="width: 150px; display: inline-block;">Filter</span>
        </strong>
        <br>
        <span style="width: 150px; display: inline-block;">Tanggal Pengajuan</span>
        @if (isset($filter['dari_tanggal']) && isset($filter['sampai_tanggal']))
            <span>: {{ $filter['dari_tanggal'] }} - {{ $filter['sampai_tanggal'] }}</span>
        @else
            <span>: Semua Tanggal</span>
        @endif
        <br>
        <span style="width: 150px; display: inline-block;">Jenis Izin</span>
        <span>: {{ $filter['jenis_izin'] ?? 'Semua Jenis Izin' }}</span>
        <br>
        <span style="width: 150px; display: inline-block;">Status</span>
        <span>: {{ $filter['status'] ?? 'Semua Status' }}</span>
    </section>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle td-fit">No</th>
                    <th class="text-center align-middle">Tanggal Pengajuan</th>
                    <th class="text-center align-middle">NIP Pegawai</th>
                    <th class="text-center align-middle">Nama Pegawai</th>
                    <th class="text-center align-middle">Jenis Izin</th>
                    <th class="text-center align-middle">Status</th>
                </tr>
            </thead>
            <tbody>
                @if (count($pengajuan))
                    @foreach ($pengajuan as $item)
                        <tr>
                            <th class="text-center align-middle td-fit">{{ $loop->iteration }}</th>
                            <td class="text-center align-middle">{{ $item['tanggal_pengajuan'] }}</td>
                            <td class="text-center align-middle">{{ $item['nip'] }}</td>
                            <td class="align-middle">{{ $item['nama'] }}</td>
                            <td class="align-middle">{{ $item['jenis_izin'] }}</td>
                            <td class="text-center align-middle">
                                @if (is_null($item['status']))
                                    Pengajuan Baru
                                @elseif ($item['status'] == \App\Enums\Pengajuan\PengajuanStatus::DITOLAK)
                                    Ditolak
                                @elseif ($item['status'] == \App\Enums\Pengajuan\PengajuanStatus::DISETUJUI)
                                    Disetujui
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="6">Tidak Ada Data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>
@endsection
