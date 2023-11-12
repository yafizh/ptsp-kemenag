@extends('permohonan.layout')

@section('app-content')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-center">
            <img src="/assets/images/logos/kemenag.png" style="width: 10rem;">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 text-center py-3">
            <h2 class="text-white">PERMOHONAN MAGANG / PKL</h2>
        </div>
    </div>
    <div class="row mb-3">
        <div class="card border-0 shadow">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }} Tunggu informasi terbaru yang akan diberikan melalui pesan whatsapp.
                    </div>
                @endif
                <form action="/permohonan-magang-pkl" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_pemohon" class="form-label">Nama Permohon</label>
                        <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" required>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_telepon_pemohon" class="form-label">Nomor Telepon Pemohon</label>
                        <input type="text" class="form-control" id="nomor_telepon_pemohon" name="nomor_telepon_pemohon"
                            required>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">
                                    Nama Siswa/Mahasiswa
                                </label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="asal_sekolah" class="form-label">Asal Sekolah/Kampus</label>
                                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat_sekolah" class="form-label">
                                    Alamat Sekolah/Kampus
                                </label>
                                <textarea name="alamat_sekolah" id="alamat_sekolah" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_mulai" required name="tanggal_mulai">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tanggal_selesai" required
                                    name="tanggal_selesai">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Ajukan Permohoan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
