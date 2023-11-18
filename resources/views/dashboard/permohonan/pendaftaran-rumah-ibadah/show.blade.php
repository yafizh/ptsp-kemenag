@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-8">
                <h3>Detail Permohonan Pendaftaran Rumah Ibadah</h3>
            </div>
            <div class="col-12 col-md-4 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/permohonan-pendaftaran-rumah-ibadah"
                    class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Pemohon</label>
                            <input type="text" class="form-control" value="{{ $permohonan['nama_pemohon'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon Pemohon</label>
                            <input type="text" class="form-control" value="{{ $permohonan['nomor_telepon_pemohon'] }}"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Permohonan</label>
                            <input type="text" class="form-control" value="{{ $permohonan['tanggal_permohonan'] }}"
                                disabled>
                        </div>
                    </div>
                </div>
                <input type="file" credits="false" name="foto[]" multiple disabled />
            </div>
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Penanggung Jawab</label>
                                    <input type="text" class="form-control" value="{{ $permohonan['nama_ketua'] }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon Penanggung Jawab</label>
                                    <input type="text" class="form-control"
                                        value="{{ $permohonan['nomor_telepon_ketua'] }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Rumah Ibadah</label>
                                    <input type="text" class="form-control" value="{{ $permohonan['rumah_ibadah'] }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Rumah Ibadah</label>
                                    <input type="text" class="form-control"
                                        value="{{ $permohonan['nama_rumah_ibadah'] }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon Rumah Ibadah</label>
                                    <input type="text" class="form-control"
                                        value="{{ $permohonan['nomor_telepon_rumah_ibadah'] }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control" value="{{ $permohonan['kecamatan'] }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kelurahan</label>
                                    <input type="text" class="form-control" value="{{ $permohonan['kelurahan'] }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Luas Tanah</label>
                                    <input type="text" class="form-control" value="{{ $permohonan['luas_tanah'] }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Luas Bangunan</label>
                                    <input type="text" class="form-control" value="{{ $permohonan['luas_bangunan'] }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tahun Berdiri</label>
                                    <input type="text" class="form-control" value="{{ $permohonan['tahun_berdiri'] }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Alamat Rumah Ibadah</label>
                                    <textarea class="form-control" disabled>{{ $permohonan['alamat_rumah_ibadah'] }}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label d-block">Status</label>
                            @if (is_null($permohonan['status']))
                                <span class="badge text-bg-info">Permohonan Baru</span>
                            @elseif ($permohonan['status'] == \App\Enums\Permohonan\PermohonanStatus::DITOLAK)
                                <span class="badge text-bg-danger">Ditolak</span>
                            @elseif ($permohonan['status'] == \App\Enums\Permohonan\PermohonanStatus::DISETUJUI)
                                <span class="badge text-bg-success">Disetujui</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea @disabled(!is_null($permohonan['status'])) name="keterangan" id="keterangan" class="form-control">{{ $permohonan['keterangan'] }}</textarea>
                        </div>
                        @if (is_null($permohonan['status']))
                            <div class="d-flex justify-content-end gap-1">
                                <form
                                    action="/{{ auth()->user()->status->route() }}/permohonan-pendaftaran-rumah-ibadah/{{ $permohonan['id'] }}/tolak"
                                    method="POST">
                                    @csrf
                                    <textarea name="keterangan_ditolak" hidden></textarea>
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Yakin?')">Tolak</button>
                                </form>
                                <form
                                    action="/{{ auth()->user()->status->route() }}/permohonan-pendaftaran-rumah-ibadah/{{ $permohonan['id'] }}/terima"
                                    method="POST">
                                    @csrf
                                    <textarea name="keterangan_diterima" hidden></textarea>
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Yakin?')">Terima</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        const foto = {{ Js::from($permohonan['foto']) }};

        const files = [];
        console.log(foto)
        foto.forEach((value) => {
            files.push({
                source: value.nama_file,

                // set type to local to indicate an already uploaded file
                options: {
                    type: 'local',
                    file: {
                        name: value.nama_file_asli,
                    },
                    metadata: {
                        poster: `/storage/${value.nama_file}`,
                    },
                },
            });
        });

        FilePond.registerPlugin(FilePondPluginFilePoster);
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        const pond = FilePond.create(inputElement);
        pond.setOptions({
            files: files,
            allowMultiple: true,
        });
    </script>
    <script>
        document.getElementById('keterangan').addEventListener('input', function() {
            document.querySelector('textarea[name=keterangan_ditolak]').value = this.value;
            document.querySelector('textarea[name=keterangan_diterima]').value = this.value;
        });
    </script>
@endsection
