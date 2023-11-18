@extends('permohonan.layout')

@section('app-content')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-center">
            <img src="/assets/images/logos/kemenag.png" style="width: 10rem;">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 text-center py-3">
            <h2 class="text-white">PERMOHONAN PENGUKURAN KIBLAT</h2>
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
                <form action="" method="POST">
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
                                <label for="nama_ketua" class="form-label">
                                    Penanggung Jawab
                                </label>
                                <input type="text" class="form-control" id="nama_ketua" name="nama_ketua" required>
                            </div>
                            <div class="mb-3">
                                <label for="nomor_telepon_ketua" class="form-label">
                                    Nomor Telepon Penanggung Jawab
                                </label>
                                <input type="text" class="form-control" id="nomor_telepon_ketua"
                                    name="nomor_telepon_ketua" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat_rumah_ibadah" class="form-label">
                                    Alamat Rumah Ibadah
                                </label>
                                <textarea name="alamat_rumah_ibadah" id="alamat_rumah_ibadah" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="nama_rumah_ibadah" class="form-label">
                                    Nama Mesjid/Mushola
                                </label>
                                <input type="text" class="form-control" id="nama_rumah_ibadah" name="nama_rumah_ibadah"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="nomor_telepon_rumah_ibadah" class="form-label">
                                    Nomor Telepon Mesjid/Mushola
                                </label>
                                <input type="text" class="form-control" id="nomor_telepon_rumah_ibadah"
                                    name="nomor_telepon_rumah_ibadah" required>
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
    <script>
        document
            .getElementById('nomor_telepon_pemohon')
            .addEventListener('keydown', phoneNumberFormat);

        document
            .getElementById('nomor_telepon_ketua')
            .addEventListener('keydown', phoneNumberFormat);

        document
            .getElementById('nomor_telepon_rumah_ibadah')
            .addEventListener('keydown', phoneNumberFormat);
    </script>
@endsection
