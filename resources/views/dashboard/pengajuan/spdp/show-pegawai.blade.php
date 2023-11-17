@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Detail Pengajuan SPDP</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/pengajuan-spdp" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Berangkat</label>
                            <input type="text" class="form-control" value="{{ $pengajuan['tanggal_berangkat'] }}"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Kembali</label>
                            <input type="text" class="form-control" value="{{ $pengajuan['tanggal_kembali'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kendaraan</label>
                            <input type="text" class="form-control" value="{{ $pengajuan['jenis_kendaraan'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tujuan Keberangkatan</label>
                            <input type="text" class="form-control" value="{{ $pengajuan['tujuan'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan Keberangkatan</label>
                            <textarea class="form-control" disabled>{{ $pengajuan['keterangan_spdp'] }}</textarea>
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
