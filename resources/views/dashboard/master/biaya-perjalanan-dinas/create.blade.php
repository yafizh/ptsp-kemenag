@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Tambah Biaya Perjalanan Dinas</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/biaya-perjalanan-dinas" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="/{{ auth()->user()->status->route() }}/biaya-perjalanan-dinas" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="tingkat" class="form-label">Tingkat</label>
                                <input type="text" class="form-control" id="tingkat" name="tingkat"
                                    value="{{ old('tingkat') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="range_dari" class="form-label">Range Dari</label>
                                <input type="number" min="0" class="form-control" id="range_dari" name="range_dari"
                                    value="{{ old('range_dari') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="range_sampai" class="form-label">Range Sampai</label>
                                <input type="number" min="0" class="form-control" id="range_sampai"
                                    name="range_sampai" value="{{ old('range_sampai') }}" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
