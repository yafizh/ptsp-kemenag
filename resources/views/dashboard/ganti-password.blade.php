@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <h3 class="text-center">Ganti Password</h3>
            </div>
        </div>
        <form action="/ganti-password" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('failed'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('failed') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="password_baru" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="password_baru" name="password_baru" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_baru_konfirmasi" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="password_baru_konfirmasi"
                                    name="password_baru_konfirmasi" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Ganti Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
