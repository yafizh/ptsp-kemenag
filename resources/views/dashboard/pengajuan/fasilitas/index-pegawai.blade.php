@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Pengajuan Fasilitas</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/pengajuan-fasilitas/create" class="btn btn-primary">
                    Pengajuan Baru
                </a>
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
                                    <th class="text-center align-middle">Tanggal Pengajuan</th>
                                    <th class="text-center align-middle">Fasilitas</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan as $item)
                                    <tr>
                                        <th class="text-center align-middle td-fit">{{ $loop->iteration }}</th>
                                        <td class="text-center align-middle">{{ $item['tanggal_pengajuan'] }}</td>
                                        <td class="text-center align-middle">{{ $item['fasilitas'] }}</td>
                                        <td class="text-center align-middle">
                                            @if (is_null($item['status']))
                                                <span class="badge text-bg-info">Pengajuan Baru</span>
                                            @elseif ($item['status'] == \App\Enums\Pengajuan\PengajuanStatus::DITOLAK)
                                                <span class="badge text-bg-danger">Ditolak</span>
                                            @elseif ($item['status'] == \App\Enums\Pengajuan\PengajuanStatus::DISETUJUI)
                                                <span class="badge text-bg-success">Disetujui</span>
                                            @endif
                                        </td>
                                        <td class="td-fit align-middle">
                                            <div class="d-flex gap-1 justify-content-center">
                                                <a href="/{{ auth()->user()->status->route() }}/pengajuan-fasilitas/{{ $item['id'] }}"
                                                    class="btn btn-sm btn-info">
                                                    Detail
                                                </a>
                                                @if (is_null($item['status']))
                                                    <a href="/{{ auth()->user()->status->route() }}/pengajuan-fasilitas/{{ $item['id'] }}/edit"
                                                        class="btn btn-sm btn-warning">
                                                        Edit
                                                    </a>
                                                    <form
                                                        action="/{{ auth()->user()->status->route() }}/pengajuan-fasilitas/{{ $item['id'] }}"
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
