@extends('permohonan.layout')

@section('app-content')
    <a href="/login" class="btn btn-light m-3" style="position: absolute; top: 0; right: 0;">LOGIN PEGAWAI</a>
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-center">
            <img src="/assets/images/logos/kemenag.png" style="width: 10rem;">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 text-center py-3">
            <h2 class="mb-0 text-white">PELAYANAN TERPADU SATU PINTU (PTSP)</h2>
            <h2 class="text-white">KEMENTERIAN AGAMA</h2>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 text-center">
            <h3 class="text-white"><u>PERMOHONAN</u></h3>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 col-md-4 mb-3">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <h5>PERMOHONAN MAGANG / PKL</h5>
                    <a href="/permohonan-magang-pkl" class="btn btn-primary align-self-center rounded-1">LAKUKAN
                        PENGAJUAN</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <h5>PERMOHONAN PENGUKURAN KIBLAT</h5>
                    <a href="/permohonan-pengukuran-kiblat" class="btn btn-primary align-self-center rounded-1">LAKUKAN
                        PENGAJUAN</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <h5>PERMOHONAN PENDAFTARAN <br> RUMAH IBADAH</h5>
                    <a href="/permohonan-pendaftaran-rumah-ibadah"
                        class="btn btn-primary align-self-center rounded-1">LAKUKAN PENGAJUAN</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <h5>PERMOHONAN RISET</h5>
                    <a href="/permohonan-riset"
                        class="btn btn-primary align-self-center rounded-1">LAKUKAN PENGAJUAN</a>
                </div>
            </div>
        </div>
    </div>
@endsection
