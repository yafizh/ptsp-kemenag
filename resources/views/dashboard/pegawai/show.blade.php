@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Detail Pegawai</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/pegawai" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
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
                                    <label class="form-label">Status User</label>
                                    <input type="text" class="form-control" value="{{ $pegawai->pengguna->status }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">NIP</label>
                                    <input type="text" class="form-control" value="{{ $pegawai->nip }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="{{ $pegawai->nama }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" value="{{ $pegawai->jabatan->nama }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Pangkat</label>
                                    <input type="text" class="form-control" value="{{ $pegawai->pangkat->nama }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Golongan</label>
                                    <input type="text" class="form-control" value="{{ $pegawai->golongan->nama }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <input type="text" class="form-control" value="{{ $pegawai->jenis_kelamin }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" value="{{ $pegawai->nomor_telepon }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" value="{{ $pegawai->pendidikan_terakhir }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="tmt" class="form-label">TMT</label>
                                    <input type="text" class="form-control" value="{{ $pegawai->tmtFormatIndonesia() }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="text" class="form-control"
                                        value="{{ $pegawai->tanggalLahirFormatIndonesia() }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" value="{{ $pegawai->tempat_lahir }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" disabled>{{ $pegawai->alamat }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <h5 class="mb-3">Foto Pegawai</h5>
                <input type="file" id="filepond" credits="false" disabled>
            </div>
        </div>
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
        });
    </script>
@endsection
