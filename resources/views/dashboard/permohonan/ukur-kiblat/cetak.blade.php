@extends('dashboard.layouts.cetak')

@section('app-content')
    <h4 class="text-center my-3">Laporan Permohonan Pengukuran Kiblat</h4>
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
        <span style="width: 150px; display: inline-block;">Status</span>
        <span>: {{ $filter['status'] ?? 'Semua Status' }}</span>
    </section>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle td-fit">No</th>
                    <th class="text-center align-middle">Nama Pemohon</th>
                    <th class="text-center align-middle">Nomor Telepon Pemohon</th>
                    <th class="text-center align-middle">Nama Penanggung Jawab</th>
                    <th class="text-center align-middle">Nomor Telepon Penanggung Jawab</th>
                    <th class="text-center align-middle">Status</th>
                </tr>
            </thead>
            <tbody>
                @if (count($permohonan))
                    @foreach ($permohonan as $item)
                        <tr>
                            <td class="text-center td-fit middle-align">{{ $loop->iteration }}</td>
                            <td class="middle-align">{{ $item['nama'] }}</td>
                            <td class="middle-align text-center">{{ $item['nomor_telepon'] }}</td>
                            <td class="middle-align">{{ $item['nama_ketua'] }}</td>
                            <td class="middle-align text-center">{{ $item['nomor_telepon_ketua'] }}</td>
                            <td class="middle-align text-center">
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
                        <td class="text-center" colspan="6">Tidak Ada Data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>
@endsection
