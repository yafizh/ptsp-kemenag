@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Edit Jabatan</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/jabatan" class="btn btn-secondary">Kembali</a>
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
                        <form action="/{{ auth()->user()->status->route() }}/jabatan/{{ $jabatan->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="{{ old('nama', $jabatan->nama) }}" required>
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
