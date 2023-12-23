@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Detail Pengajuan Izin</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/pengajuan-izin" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Jenis Izin</label>
                            <input type="text" class="form-control" value="{{ $pengajuan['jenis_izin'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="text" class="form-control" value="{{ $pengajuan['tanggal_mulai'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="text" class="form-control" value="{{ $pengajuan['tanggal_selesai'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan Izin</label>
                            <textarea class="form-control" disabled>{{ $pengajuan['keterangan_izin'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pengajuan</label>
                            <input type="text" class="form-control" value="{{ $pengajuan['tanggal_pengajuan'] }}"
                                disabled>
                        </div>
                        @if (!is_null($pengajuan['status']))
                            <div class="mb-3">
                                <label class="form-label">Tanggal Verifikasi</label>
                                <input type="text" class="form-control" value="{{ $pengajuan['tanggal_verifikasi'] }}"
                                    disabled>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label d-block">Status</label>
                            @if (is_null($pengajuan['status']))
                                <span class="badge text-bg-info">Pengajuan Baru</span>
                            @elseif ($pengajuan['status'] == \App\Enums\Pengajuan\PengajuanStatus::DITOLAK)
                                <span class="badge text-bg-danger">Ditolak</span>
                            @elseif ($pengajuan['status'] == \App\Enums\Pengajuan\PengajuanStatus::DISETUJUI)
                                <span class="badge text-bg-success">Disetujui</span>
                            @endif
                        </div>
                        @if (!is_null($pengajuan['status']))
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" disabled>{{ $pengajuan['keterangan_verifikasi'] }}</textarea>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
