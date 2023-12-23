@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Biaya Perjalanan Dinas</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/biaya-perjalanan-dinas/create"
                    class="btn btn-primary">Tambah</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle td-fit">No</th>
                                    <th class="text-center align-middle">Tingkat</th>
                                    <th class="text-center align-middle">Range Dari</th>
                                    <th class="text-center align-middle">Range Sampai</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($biayaPerjalanDinas as $item)
                                    <tr>
                                        <th class="text-center td-fit">{{ $loop->iteration }}</th>
                                        <td class="text-center">{{ $item->tingkat }}</td>
                                        <td class="text-center">{{ number_format($item->range_dari, 0, '.', '.') }}</td>
                                        <td class="text-center">{{ number_format($item->range_sampai, 0, '.', '.') }}</td>
                                        <td class="td-fit">
                                            <div class="d-flex gap-1">
                                                <a href="/{{ auth()->user()->status->route() }}/biaya-perjalanan-dinas/{{ $item->id }}/edit"
                                                    class="btn btn-sm btn-warning">
                                                    Edit
                                                </a>
                                                <form
                                                    action="/{{ auth()->user()->status->route() }}/biaya-perjalanan-dinas/{{ $item->id }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin?')">Hapus</a>
                                                </form>
                                            </div>
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
