@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Edit Pengajuan</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/pengajuan-spdp" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/{{ auth()->user()->status->route() }}/pengajuan-spdp/{{ $pengajuan['id'] }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
                                <input type="date" class="form-control" id="tanggal_berangkat" name="tanggal_berangkat"
                                    value="{{ old('tanggal_berangkat', $pengajuan['tanggal_berangkat']) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                                <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali"
                                    value="{{ old('tanggal_kembali', $pengajuan['tanggal_kembali']) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                                <select name="jenis_kendaraan" class="form-control" id="jenis_kendaraan" required>
                                    <option value="" disabled selected>Pilih Jenis Kendaraan</option>
                                    @foreach ($jenisKendaraan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == old('jenis_kendaraan', $pengajuan['jenis_kendaraan']) ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Tujuan Keberangkatan</label>
                                <input type="text" class="form-control" id="tujuan" name="tujuan"
                                    value="{{ old('tujuan', $pengajuan['tujuan']) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" required>{{ old('keterangan', $pengajuan['keterangan']) }}</textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Perbaharui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
