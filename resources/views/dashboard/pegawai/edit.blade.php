@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Edit Pegawai</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/pegawai" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <form action="/{{ auth()->user()->status->route() }}/pegawai/{{ $pegawai->id }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                        <label for="status_user" class="form-label">Status User</label>
                                        <select name="status_user" class="form-control" id="status_user" required>
                                            <option value="" disabled selected>Pilih Status User</option>
                                            @foreach (\App\Enums\User\UserStatus::cases() as $userStatus)
                                                <option value="{{ $userStatus->value }}"
                                                    {{ $userStatus->value == old('status_user', $pegawai->pengguna->status->value) ? 'selected' : '' }}>
                                                    {{ $userStatus->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="number" min="0" class="form-control" id="nip"
                                            name="nip" value="{{ old('nip', $pegawai->nip) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ old('nama', $pegawai->nama) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="jabatan" class="form-label">Jabatan</label>
                                        <select name="jabatan" class="form-control" id="jabatan" required>
                                            <option value="" disabled selected>Pilih Jabatan</option>
                                            @foreach ($jabatan as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == old('jabatan', $pegawai->id_jabatan) ? 'selected' : '' }}>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="pangkat" class="form-label">Pangkat</label>
                                        <select name="pangkat" class="form-control" id="pangkat" required>
                                            <option value="" disabled selected>Pilih Pangkat</option>
                                            @foreach ($pangkat as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == old('pangkat', $pegawai->id_pangkat) ? 'selected' : '' }}>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="golongan" class="form-label">Golongan</label>
                                        <select name="golongan" class="form-control" id="golongan" required>
                                            <option value="" disabled selected>Pilih Golongan</option>
                                            @foreach ($golongan as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == old('golongan', $pegawai->id_golongan) ? 'selected' : '' }}>
                                                    {{ $item->nama }}
                                                </option>
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
                                                    {{ $jenisKelamin->value == old('jenis_kelamin', $pegawai->jenis_kelamin->value) ? 'selected' : '' }}>
                                                    {{ $jenisKelamin->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                            value="{{ old('nomor_telepon', $pegawai->nomor_telepon) }}" required>
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
                                                    {{ $pendidikanTerakhir->value == old('pendidikan_terakhir', $pegawai->pendidikan_terakhir->value) ? 'selected' : '' }}>
                                                    {{ $pendidikanTerakhir->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="tmt" class="form-label">TMT</label>
                                        <input type="date" class="form-control" id="tmt" name="tmt"
                                            value="{{ old('tmt', $pegawai->tmt) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir"
                                            name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat', $pegawai->alamat) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="form-text">Perubahan NIP akan digunakan sebagai username dan password saat
                                    login.</div>
                                <button type="submit" class="btn btn-primary">Perbaharui</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <h5 class="mb-3">Foto Pegawai</h5>
                    <input type="file" id="filepond" name="foto" credits="false" required>
                </div>
            </div>
        </form>
    </div>
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        FilePond.registerPlugin(FilePondPluginFilePoster);
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);

        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create(inputElement);
        pond.setOptions({
            acceptedFileTypes: ['image/*'],
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    resolve(type);
                }),
            files: [{
                source: {{ Js::from($pegawai->foto->nama_file) }},
                options: {
                    type: 'local',
                    file: {
                        name: {{ Js::from($pegawai->foto->nama_file_asli) }},
                    },
                    metadata: {
                        poster: {{ Js::from(asset('storage/' . $pegawai->foto->nama_file)) }},
                    },
                },
            }],
            server: {
                process: '/uploads/process',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                },
            },
        });
    </script>
    <script>
        document
            .getElementById('nomor_telepon')
            .addEventListener('keydown', phoneNumberFormat);
    </script>
@endsection
