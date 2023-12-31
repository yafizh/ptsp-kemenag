@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Pengajuan Baru</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/pengajuan-cuti" class="btn btn-secondary">Kembali</a>
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
                        <form action="/{{ auth()->user()->status->route() }}/pengajuan-spdp" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
                                    <input type="date" class="form-control" id="tanggal_berangkat"
                                        name="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}" required>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                                    <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali"
                                        value="{{ old('tanggal_kembali') }}" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="jenis_kendaraan" class="form-label">Jenis Transportasi</label>
                                    <select name="jenis_kendaraan" class="form-control" id="jenis_kendaraan" required>
                                        <option value="" disabled selected>Pilih Jenis Transportasi</option>
                                        @foreach ($jenisKendaraan as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == old('jenis_kendaraan') ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="tempat_berangkat" class="form-label">Tempat Berangkat</label>
                                    <input type="text" class="form-control" id="tempat_berangkat" name="tempat_berangkat"
                                        value="{{ old('tempat_berangkat') }}" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="tempat_tujuan" class="form-label">Tempat Tujuan</label>
                                    <input type="text" class="form-control" id="tempat_tujuan" name="tempat_tujuan"
                                        value="{{ old('tempat_tujuan') }}" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="maksud_perjalanan_dinas" class="form-label">Maksud Perjalan Dinas</label>
                                    <textarea name="maksud_perjalanan_dinas" id="maksud_perjalanan_dinas" class="form-control" required>{{ old('maksud_perjalanan_dinas') }}</textarea>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Ajukan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
