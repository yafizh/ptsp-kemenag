@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Detail Riset</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/permohonan-riset" class="btn btn-secondary">Kembali</a>
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
                            <label class="form-label">Nama Pemohon</label>
                            <input type="text" class="form-control" value="{{ $permohonan['nama_pemohon'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon Pemohon</label>
                            <input type="text" class="form-control" value="{{ $permohonan['nomor_telepon_pemohon'] }}"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Permohonan</label>
                            <input type="text" class="form-control" value="{{ $permohonan['tanggal_permohonan'] }}"
                                disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Asal Instansi</label>
                                    <input type="text" class="form-control" value="{{ $permohonan['asal_instansi'] }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Keperluan</label>
                                    <textarea class="form-control" rows="1" disabled>{{ $permohonan['keperluan'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Mulai</label>
                                    <input type="text" class="form-control" value="{{ $permohonan['tanggal_mulai'] }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Selesai</label>
                                    <input type="text" class="form-control" value="{{ $permohonan['tanggal_selesai'] }}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label d-block">Status</label>
                            @if (is_null($permohonan['status']))
                                <span class="badge text-bg-info">Permohonan Baru</span>
                            @elseif ($permohonan['status'] == \App\Enums\Permohonan\PermohonanStatus::DITOLAK)
                                <span class="badge text-bg-danger">Ditolak</span>
                            @elseif ($permohonan['status'] == \App\Enums\Permohonan\PermohonanStatus::DISETUJUI)
                                <span class="badge text-bg-success">Disetujui</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea @disabled(!is_null($permohonan['status'])) name="keterangan" id="keterangan" class="form-control">{{ $permohonan['keterangan'] }}</textarea>
                        </div>
                        @if (is_null($permohonan['status']))
                            <div class="d-flex justify-content-end gap-1">
                                <form
                                    action="/{{ auth()->user()->status->route() }}/permohonan-riset/{{ $permohonan['id'] }}/tolak"
                                    method="POST">
                                    @csrf
                                    <textarea name="keterangan_ditolak" hidden></textarea>
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Yakin?')">Tolak</button>
                                </form>
                                <form
                                    action="/{{ auth()->user()->status->route() }}/permohonan-riset/{{ $permohonan['id'] }}/terima"
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
