@extends('permohonan.layout')

@section('app-content')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-center">
            <img src="/assets/images/logos/kemenag.png" style="width: 10rem;">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 text-center py-3">
            <h2 class="text-white">PERMOHONAN PENDAFTARAN RUMAH IBADAH</h2>
        </div>
    </div>
    <div class="row mb-3">
        <div class="card border-0 shadow">
            <div class="card-body">
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
                                <label for="tahun_berdiri" class="form-label">
                                    Tahun Berdiri
                                </label>
                                <input type="text" class="form-control" id="tahun_berdiri" name="tahun_berdiri" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_rumah_ibadah" class="form-label">
                                    Nama Rumah Ibadah
                                </label>
                                <input type="text" class="form-control" id="nama_rumah_ibadah" name="nama_rumah_ibadah"
                                    required>
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
                                <label for="kecamatan" class="form-label">
                                    Kecamatan
                                </label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                            </div>
                            <div class="mb-3">
                                <label for="kelurahan" class="form-label">
                                    Kelurahan
                                </label>
                                <input type="text" class="form-control" id="kelurahan" name="kelurahan" required>
                            </div>
                            <div class="mb-3">
                                <label for="luas_tanah" class="form-label">
                                    Luas Tanah
                                </label>
                                <input type="number" class="form-control" id="luas_tanah" name="luas_tanah" required>
                            </div>
                            <div class="mb-3">
                                <label for="luas_bangunan" class="form-label">
                                    Luas Bangunan
                                </label>
                                <input type="number" class="form-control" id="luas_bangunan" name="luas_bangunan" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div>
                        Images here
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
