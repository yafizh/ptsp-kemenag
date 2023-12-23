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
                            <label for="keterangan" class="form-label">Keterangan Verifikasi</label>
                            <textarea @disabled(!is_null($pengajuan['status'])) name="keterangan" id="keterangan" class="form-control">{{ $pengajuan['keterangan_verifikasi'] }}</textarea>
                        </div>
                        @if (is_null($pengajuan['status']))
                            <div class="d-flex justify-content-end gap-1">
                                <form
                                    action="/{{ auth()->user()->status->route() }}/pengajuan-izin/{{ $pengajuan['id'] }}/tolak"
                                    method="POST">
                                    @csrf
                                    <textarea name="keterangan_ditolak" hidden></textarea>
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Yakin?')">Tolak</button>
                                </form>
                                <form
                                    action="/{{ auth()->user()->status->route() }}/pengajuan-izin/{{ $pengajuan['id'] }}/terima"
                                    method="POST">
                                    @csrf
                                    <textarea name="keterangan_diterima" hidden></textarea>
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Yakin?')">Terima</button>
                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('keterangan').addEventListener('input', function() {
            document.querySelector('textarea[name=keterangan_ditolak]').value = this.value;
            document.querySelector('textarea[name=keterangan_diterima]').value = this.value;
        });
    </script>
@endsection
