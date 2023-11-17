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
                        <form action="/{{ auth()->user()->status->route() }}/pengajuan-cuti" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
                                <select name="jenis_cuti" class="form-control" id="jenis_cuti" required>
                                    <option value="" disabled selected>Pilih Jenis Cuti</option>
                                    @foreach ($jenisCuti as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == old('jenis_cuti') ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai Cuti</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                    value="{{ old('tanggal_mulai') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai Cuti</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                                    value="{{ old('tanggal_selesai') }}" required>
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
