@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <h3>Laporan Permohonan Riset</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6>Filter</h6>
                        <hr>
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="dari_tanggal" class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" name="dari_tanggal" id="dari_tanggal"
                                    value="{{ $_POST['dari_tanggal'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="sampai_tanggal" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" name="sampai_tanggal" id="sampai_tanggal"
                                    value="{{ $_POST['sampai_tanggal'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="" selected>Semua Status</option>
                                    <option value="Permohonan Baru"
                                        {{ ($_POST['status'] ?? '') == 'Permohonan Baru' ? 'selected' : '' }}>Permohonan
                                        Baru
                                    </option>
                                    @foreach (\App\Enums\Permohonan\PermohonanStatus::cases() as $item)
                                        <option value="{{ $item->value }}"
                                            {{ ($_POST['status'] ?? '') == $item->value ? 'selected' : '' }}>
                                            {{ $item->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="/{{ auth()->user()->status->route() }}/{{ request()->segment(2) }}/{{ request()->segment(3) }}"
                                    class="btn btn-secondary">
                                    Reset Filter
                                </a>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6>Hasil Filter</h6>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="text" class="form-control" disabled
                                value="{{ $filter['dari_tanggal'] ?? 'Semua Tanggal' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="text" class="form-control" disabled
                                value="{{ $filter['sampai_tanggal'] ?? 'Semua Tanggal' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <input type="text" class="form-control" disabled
                                value="{{ $filter['status'] ?? 'Semua Status' }}">
                        </div>
                        <div class="d-flex justify-content-end">
                            <form action="" method="POST" target="_blank">
                                @csrf
                                <input type="text" hidden name="print" value="1">
                                <input type="text" hidden name="dari_tanggal"
                                    value="{{ $_POST['dari_tanggal'] ?? '' }}">
                                <input type="text" hidden name="sampai_tanggal"
                                    value="{{ $_POST['sampai_tanggal'] ?? '' }}">
                                <input type="text" hidden name="status_tanggal"
                                    value="{{ $_POST['status_tanggal'] ?? '' }}">
                                <button class="btn btn-info">Print</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle td-fit">No</th>
                                    <th class="text-center align-middle">Tanggal Permohonan</th>
                                    <th class="text-center align-middle">Nama Pemohon</th>
                                    <th class="text-center align-middle">Nomor Telepon Pemohon</th>
                                    <th class="text-center align-middle">Asal Instansi</th>
                                    <th class="text-center align-middle">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permohonan as $item)
                                    <tr>
                                        <th class="text-center align-middle td-fit">{{ $loop->iteration }}</th>
                                        <td class="text-center align-middle">{{ $item['tanggal_permohonan'] }}</td>
                                        <td class="align-middle">{{ $item['nama'] }}</td>
                                        <td class="text-center align-middle">{{ $item['nomor_telepon'] }}</td>
                                        <td class="align-middle">{{ $item['asal_instansi'] }}</td>
                                        <td class="text-center align-middle">
                                            @if (is_null($item['status']))
                                                <span class="badge text-bg-info">Permohonan Baru</span>
                                            @elseif ($item['status'] == \App\Enums\Permohonan\PermohonanStatus::DITOLAK)
                                                <span class="badge text-bg-danger">Ditolak</span>
                                            @elseif ($item['status'] == \App\Enums\Permohonan\PermohonanStatus::DISETUJUI)
                                                <span class="badge text-bg-success">Disetujui</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
