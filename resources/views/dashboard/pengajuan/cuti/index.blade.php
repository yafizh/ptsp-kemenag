@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Pengajuan Cuti</h3>
            </div>
            @if (auth()->user()->status == \App\Enums\User\UserStatus::PEGAWAI ||
                    auth()->user()->status == \App\Enums\User\UserStatus::PIMPINAN)
                <div class="col-12 col-md-6 d-flex justify-content-end">
                    <a href="/{{ auth()->user()->status->route() }}/pengajuan-cuti/create" class="btn btn-primary">
                        Pengajuan Baru
                    </a>
                </div>
            @endif
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
                                    @if (auth()->user()->status == \App\Enums\User\UserStatus::ADMIN ||
                                            auth()->user()->status == \App\Enums\User\UserStatus::PIMPINAN)
                                        <th class="text-center align-middle">NIP</th>
                                        <th class="text-center align-middle">Nama</th>
                                    @endif
                                    <th class="text-center align-middle">Tanggal Pengajuan</th>
                                    <th class="text-center align-middle">Jenis Cuti</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan as $item)
                                    <tr>
                                        <th class="text-center td-fit">{{ $loop->iteration }}</th>
                                        @if (auth()->user()->status == \App\Enums\User\UserStatus::ADMIN ||
                                                auth()->user()->status == \App\Enums\User\UserStatus::PIMPINAN)
                                            <td class="text-center">{{ $item['nip'] }}</td>
                                            <td>{{ $item['nama'] }}</td>
                                        @endif
                                        <td class="text-center">{{ $item['tanggal_pengajuan'] }}</td>
                                        <td class="text-center">{{ $item['jenis_cuti'] }}</td>
                                        <td class="text-center">
                                            @if (is_null($item['status']))
                                                <span class="badge text-bg-info">Pengajuan Baru</span>
                                            @elseif ($item['status'] == \App\Enums\Pengajuan\PengajuanStatus::DITOLAK)
                                                <span class="badge text-bg-danger">Ditolak</span>
                                            @elseif ($item['status'] == \App\Enums\Pengajuan\PengajuanStatus::DISETUJUI)
                                                <span class="badge text-bg-success">Disetujui</span>
                                            @endif
                                        </td>
                                        <td class="td-fit">
                                            <div class="d-flex gap-1">
                                                <a href="/{{ auth()->user()->status->route() }}/pengajuan-cuti/{{ $item['id'] }}"
                                                    class="btn btn-sm btn-info">
                                                    Detail
                                                </a>
                                                @if (auth()->user()->status == \App\Enums\User\UserStatus::ADMIN)
                                                    <a href="/{{ auth()->user()->status->route() }}/pengajuan-cuti/{{ $item['id'] }}/edit"
                                                        class="btn btn-sm btn-warning">
                                                        Edit
                                                    </a>
                                                    <form
                                                        action="/{{ auth()->user()->status->route() }}/pengajuan-cuti/{{ $item['id'] }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin?')">Hapus</a>
                                                    </form>
                                                @endif
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
