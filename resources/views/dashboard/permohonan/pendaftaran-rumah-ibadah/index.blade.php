@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <h3>Permohonan Pendaftaran Rumah Ibadah</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle td-fit">No</th>
                                    <th class="text-center align-middle">Nama Pemohon</th>
                                    <th class="text-center align-middle">Nomor Telepon Pemohon</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permohonan as $item)
                                    <tr>
                                        <th class="text-center td-fit">{{ $loop->iteration }}</th>
                                        <td>{{ $item['nama'] }}</td>
                                        <td class="text-center">{{ $item['nomor_telepon'] }}</td>
                                        <td class="text-center">
                                            @if (is_null($item['status']))
                                                <span class="badge text-bg-info">Permohonan Baru</span>
                                            @elseif ($item['status'] == \App\Enums\Permohonan\PermohonanStatus::DITOLAK)
                                                <span class="badge text-bg-danger">Ditolak</span>
                                            @elseif ($item['status'] == \App\Enums\Permohonan\PermohonanStatus::DISETUJUI)
                                                <span class="badge text-bg-success">Disetujui</span>
                                            @endif
                                        </td>
                                        <td class="td-fit">
                                            <div class="d-flex gap-1">
                                                <a href="/{{ auth()->user()->status->route() }}/permohonan-pendaftaran-rumah-ibadah/{{ $item['id'] }}"
                                                    class="btn btn-sm btn-info">
                                                    Detail
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
