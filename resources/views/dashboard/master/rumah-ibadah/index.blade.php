@extends('dashboard.layouts.main')

@section('app-content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <h3>Rumah Ibadah</h3>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="/{{ auth()->user()->status->route() }}/rumah-ibadah/create" class="btn btn-primary">Tambah</a>
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
                                    <th class="text-center align-middle">Nama</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rumahIbadah as $item)
                                    <tr>
                                        <th class="text-center td-fit">{{ $loop->iteration }}</th>
                                        <td class="text-center">{{ $item->nama }}</td>
                                        <td class="td-fit">
                                            <div class="d-flex gap-1">
                                                <a href="/{{ auth()->user()->status->route() }}/rumah-ibadah/{{ $item->id }}/edit"
                                                    class="btn btn-sm btn-warning">
                                                    Edit
                                                </a>
                                                <form
                                                    action="/{{ auth()->user()->status->route() }}/rumah-ibadah/{{ $item->id }}"
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
