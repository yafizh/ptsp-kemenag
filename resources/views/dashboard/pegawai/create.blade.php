@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Tambah Pegawai</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/pegawai" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <form action="/{{ auth()->user()->status->route() }}/pegawai" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
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
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="number" min="0" class="form-control" id="nip"
                                            name="nip" value="{{ old('nip') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ old('nama') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="jabatan" class="form-label">Jabatan</label>
                                        <select name="jabatan" class="form-control" id="jabatan" required>
                                            <option value="" disabled selected>Pilih Jabatan</option>
                                            @foreach (\App\Enums\Pegawai\PegawaiJabatan::cases() as $jabatan)
                                                <option value="{{ $jabatan->value }}"
                                                    {{ $jabatan->value == old('jabatan') ? 'selected' : '' }}>
                                                    {{ $jabatan->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                            @foreach (\App\Enums\Umum\JenisKelamin::cases() as $jenisKelamin)
                                                <option value="{{ $jenisKelamin->value }}"
                                                    {{ $jenisKelamin->value == old('jenis_kelamin') ? 'selected' : '' }}>
                                                    {{ $jenisKelamin->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                            value="{{ old('nomor_telepon') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                        <select name="pendidikan_terakhir" class="form-control" id="pendidikan_terakhir"
                                            required>
                                            <option value="" disabled selected>Pilih Pendidikan Terakhir</option>
                                            @foreach (\App\Enums\Umum\PendidikanTerakhir::cases() as $pendidikanTerakhir)
                                                <option value="{{ $pendidikanTerakhir->value }}"
                                                    {{ $pendidikanTerakhir->value == old('pendidikan_terakhir') ? 'selected' : '' }}>
                                                    {{ $pendidikanTerakhir->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="tmt" class="form-label">TMT</label>
                                        <input type="date" class="form-control" id="tmt" name="tmt"
                                            value="{{ old('tmt') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            value="{{ old('tempat_lahir') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="form-text">NIP akan digunakan sebagai username dan password saat login
                                    untuk
                                    pertama kalinya.</div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <h5 class="mb-3">Foto Pegawai</h5>
                    <input type="file" id="filepond" name="foto" required credits="false">
                </div>
            </div>
        </form>
    </div>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        const pond = FilePond.create(inputElement).setOptions({
            acceptedFileTypes: ['image/*'],
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    resolve(type);
                }),
            server: {
                process: '/uploads/process',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                },
            },
            // allowMultiple: true,
        });
    </script>
    <script>
        document
            .getElementById('nomor_telepon')
            .addEventListener('keydown', phoneNumberFormat);
    </script>
@endsection
