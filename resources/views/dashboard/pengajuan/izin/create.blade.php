@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Pengajuan Baru</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/pengajuan-izin" class="btn btn-secondary">Kembali</a>
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
                        <form action="/{{ auth()->user()->status->route() }}/pengajuan-izin" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="jenis_izin" class="form-label">Jenis Izin</label>
                                <select name="jenis_izin" class="form-control" id="jenis_izin" required>
                                    <option value="" disabled selected>Pilih Jenis Izin</option>
                                    @foreach ($jenisIzin as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == old('jenis_izin') ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai Izin</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                    value="{{ old('tanggal_mulai') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai Izin</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                                    value="{{ old('tanggal_selesai') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="1" class="form-control" required></textarea>
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
