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
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">NIP Pegawai</label>
                            <input type="text" class="form-control" value="{{ $pengajuan['nip'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Pegawai</label>
                            <input type="text" class="form-control" value="{{ $pengajuan['nama'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pengajuan</label>
                            <input type="text" class="form-control" value="{{ $pengajuan['tanggal_pengajuan'] }}"
                                disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form
                            action="/{{ auth()->user()->status->route() }}/pengajuan-spdp/{{ $pengajuan['id'] }}/verifikasi"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label">Tanggal Berangkat</label>
                                    <input type="text" class="form-control" value="{{ $pengajuan['tanggal_berangkat'] }}"
                                        disabled>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label">Tanggal Kembali</label>
                                    <input type="text" class="form-control" value="{{ $pengajuan['tanggal_kembali'] }}"
                                        disabled>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Jenis Transportasi</label>
                                    <input type="text" class="form-control" value="{{ $pengajuan['jenis_kendaraan'] }}"
                                        disabled>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Tempat Berangkat</label>
                                    <input type="text" class="form-control" value="{{ $pengajuan['tempat_berangkat'] }}"
                                        disabled>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Tempat Tujuan</label>
                                    <input type="text" class="form-control" value="{{ $pengajuan['tempat_tujuan'] }}"
                                        disabled>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Maksud Perjalanan Dinas</label>
                                    <textarea class="form-control" disabled>{{ $pengajuan['maksud_perjalanan_dinas'] }}</textarea>
                                </div>
                            </div>
                            <hr>
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
                            <hr>
                            <div class="mb-3">
                                <label for="biaya_perjalanan_dinas" class="form-label d-block">Biaya Perjalanan
                                    Dinas</label>
                                @if (is_null($pengajuan['status']))
                                    <select name="biaya_perjalanan_dinas" id="biaya_perjalanan_dinas" class="form-control"
                                        required>
                                        <option value="" selected disabled>Pilih Biaya Perjalanan Dinas</option>
                                        @foreach ($biayaPerjalananDinas as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->tingkat }} | {{ number_format($item->range_dari, 0, ',', '.') }}
                                                -
                                                {{ number_format($item->range_sampai, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control"
                                        value="{{ $pengajuan['biaya_perjalanan_dinas_tingkat'] }} | {{ number_format($pengajuan['biaya_perjalanan_dinas_range_dari'], 0, ',', '.') }} - {{ number_format($pengajuan['biaya_perjalanan_dinas_range_sampai'], 0, ',', '.') }}"
                                        disabled>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea @disabled(!is_null($pengajuan['status'])) name="keterangan" id="keterangan" class="form-control" required>{{ $pengajuan['keterangan_verifikasi'] }}</textarea>
                            </div>
                            @if (!is_null($pengajuan['status']))
                                <label class="form-label d-block">File SPDP</label>
                                <a href="/{{ auth()->user()->status->route() }}/pengajuan-spdp/{{ $pengajuan['id'] }}/spdp"
                                    target="_blank">
                                    PDF File
                                </a>
                            @endif
                            @if (is_null($pengajuan['status']))
                                <div class="d-flex justify-content-end gap-1">
                                    <button type="submit" name="tolak" class="btn btn-danger"
                                        onclick="return confirm('Yakin?')">
                                        Tolak
                                    </button>
                                    <button type="submit" name="terima" class="btn btn-success"
                                        onclick="return confirm('Yakin?')">
                                        Terima
                                    </button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
