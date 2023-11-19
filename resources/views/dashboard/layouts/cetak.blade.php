<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan</title>
    <link href="/assets/css/styles.min.css" rel="stylesheet">
</head>

<body>
    <header class="text-center p-4">
        <img src="/assets/images/logos/kemenag.png" alt="Logo" width="110" style="position: absolute; left: 30px;">
        <h4>KEMENTERIAN AGAMA</h4>
        <h4>BANJARBARU</h4>
        Jl. R. Soeprapto, Rantau Kiwa, Kec. Tapin Utara,
        <br>
        Kabupaten Tapin, Kalimantan Selatan 71152
    </header>
    <div class="d-flex flex-column justify-content-center w-100">
        <div style="width: 100%; border-top: 3px solid black;"></div>
    </div>
    <style>
        @page {
            size: landscape;
            /* auto is the initial value */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }

        .td-fit {
            width: 1%;
            white-space: nowrap;
        }
    </style>
    @yield('app-content')
    <footer class="d-flex justify-content-end p-3">
        <div class="text-center">
            <h6>Banjarbaru, {{ $filter['today'] }}</h6>
            <br><br><br><br><br>
            @if (auth()->user()->status == \App\Enums\User\UserStatus::ADMIN)
                <h6>ADMIN</h6>
            @elseif (auth()->user()->status == \App\Enums\User\UserStatus::PIMPINAN)
                <h6 class="mb-0">{{ auth()->user()->pegawai->nama }}</h6>
                <div class="my-1" style="width: 12rem; border-top: 2px solid black;"></div>
                <h6>{{ auth()->user()->pegawai->nip }}</h6>
            @endif
        </div>
    </footer>
    <script src="/assets/js/app.min.js"></script>
    <script>
        window.print();
    </script>
</body>

</html>
