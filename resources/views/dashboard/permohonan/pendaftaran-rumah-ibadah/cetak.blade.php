@extends('dashboard.layouts.cetak')

@section('app-content')
    <h4 class="text-center my-3">Laporan Permohonan Pendaftara Rumah Ibadah</h4>
    <section class="p-3">
        <strong>
            <span style="width: 150px; display: inline-block;">Filter</span>
        </strong>
        <br>
        <span style="width: 150px; display: inline-block;">Tanggal</span>
        @if (isset($filter['dari_tanggal']) && isset($filter['sampai_tanggal']))
            <span>: {{ $filter['dari_tanggal'] }} - {{ $filter['sampai_tanggal'] }}</span>
        @else
            <span>: Semua Tanggal</span>
        @endif
        <br>
        <span style="width: 150px; display: inline-block;">Rumah Ibadah</span>
        <span>: {{ $filter['rumah_ibadah'] ?? 'Semua Rumah Ibadah' }}</span>
        <br>
        <span style="width: 150px; display: inline-block;">Status</span>
        <span>: {{ $filter['status'] ?? 'Semua Status' }}</span>
    </section>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle td-fit">No</th>
                    <th class="text-center align-middle">Tanggal Permohonan</th>
                    <th class="text-center align-middle">Nama Pemohon</th>
                    <th class="text-center align-middle">Nomor Telepon Pemohon</th>
                    <th class="text-center align-middle">Rumah Ibadah</th>
                    <th class="text-center align-middle">Nama Rumah Ibadah</th>
                    <th class="text-center align-middle">Tahun Berdiri</th>
                    <th class="text-center align-middle">Status</th>
                </tr>
            </thead>
            <tbody>
                @if (count($permohonan))
                    @foreach ($permohonan as $item)
                        <tr>
                            <th class="text-center align-middle td-fit">{{ $loop->iteration }}</th>
                            <td class="text-center align-middle">{{ $item['tanggal_permohonan'] }}</td>
                            <td class="align-middle">{{ $item['nama'] }}</td>
                            <td class="text-center align-middle">{{ $item['nomor_telepon'] }}</td>
                            <td class="align-middle">{{ $item['rumah_ibadah'] }}</td>
                            <td class="align-middle">{{ $item['nama_rumah_ibadah'] }}</td>
                            <td class="text-center align-middle">{{ $item['tahun_berdiri'] }}</td>
                            <td class="text-center align-middle">
                                @if (is_null($item['status']))
                                    Permohonan Baru
                                @elseif ($item['status'] == \App\Enums\Permohonan\PermohonanStatus::DITOLAK)
                                    Ditolak
                                @elseif ($item['status'] == \App\Enums\Permohonan\PermohonanStatus::DISETUJUI)
                                    Disetujui
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="8">Tidak Ada Data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>
@endsection
