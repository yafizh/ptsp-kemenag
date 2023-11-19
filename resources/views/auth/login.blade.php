<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" type="image/png" href="/assets/images/logos/kemenag.png">
    <link rel="stylesheet" href="/assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <a href="/">
                                        <img src="/assets/images/logos/kemenag.png" width="100" alt="">
                                        <h5 class="mb-0 my-3">PELAYANAN TERPADU SATU PINTU (PTSP)</h5>
                                        <h5>KEMENTERIAN AGAMA</h5>
                                    </a>

                                </div>
                                @if (session('failed'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('failed') }}
                                    </div>
                                @endif
                                <form action="/auth" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">NIP</label>
                                        <input type="text" class="form-control" name="username" id="username"
                                            required autofocus>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end mb-4">
                                        <a class="text-primary fw-bold" href="#">Lupa Password ?</a>
                                    </div>
                                    {{-- <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                                        Login
                                    </button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
