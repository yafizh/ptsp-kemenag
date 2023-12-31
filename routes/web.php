<?php

use App\Enums\User\UserStatus;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\BiayaPerjalananDinasController;
use App\Http\Controllers\Master\GolonganController;
use App\Http\Controllers\Master\JabatanController;
use App\Http\Controllers\Master\JenisCutiController;
use App\Http\Controllers\Master\JenisIzinController;
use App\Http\Controllers\Master\JenisKendaraanController;
use App\Http\Controllers\Master\PangkatController;
use App\Http\Controllers\Master\RumahIbadahController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\Pengajuan\PengajuanCutiController;
use App\Http\Controllers\Pengajuan\PengajuanFasilitasController;
use App\Http\Controllers\Pengajuan\PengajuanIzinController;
use App\Http\Controllers\Pengajuan\PengajuanSPDPController;
use App\Http\Controllers\Permohonan\PermohonanController;
use App\Http\Controllers\Permohonan\PermohonanMagangPKLController;
use App\Http\Controllers\Permohonan\PermohonanPendaftaranRumahIbadahController;
use App\Http\Controllers\Permohonan\PermohonanRisetController;
use App\Http\Controllers\Permohonan\PermohonanUkurKiblatController;
use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::prefix(UserStatus::ADMIN->route())->group(function () {
        Route::get('/', [DashboardController::class, 'admin']);
        Route::resource('pegawai', PegawaiController::class);
        Route::resource('rumah-ibadah', RumahIbadahController::class);
        Route::resource('jenis-cuti', JenisCutiController::class);
        Route::resource('jenis-izin', JenisIzinController::class);
        Route::resource('jenis-kendaraan', JenisKendaraanController::class);
        Route::resource('golongan', GolonganController::class);
        Route::resource('jabatan', JabatanController::class);
        Route::resource('pangkat', PangkatController::class);
        Route::resource('biaya-perjalanan-dinas', BiayaPerjalananDinasController::class)
            ->parameters([
                'biaya-perjalanan-dinas' => 'biayaPerjalananDinas'
            ]);

        Route::controller(PermohonanMagangPKLController::class)
            ->prefix('/permohonan-magang-pkl')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/laporan', 'laporan');
                Route::get('/print', 'print');
                Route::get('/{permohonan}', 'show');
                Route::post('/{permohonan}/tolak', 'tolak');
                Route::post('/{permohonan}/terima', 'terima');
            });

        Route::controller(PermohonanUkurKiblatController::class)
            ->prefix('/permohonan-ukur-kiblat')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::get('/{permohonan}', 'show');
                Route::post('/{permohonan}/tolak', 'tolak');
                Route::post('/{permohonan}/terima', 'terima');
            });

        Route::controller(PermohonanPendaftaranRumahIbadahController::class)
            ->prefix('/permohonan-pendaftaran-rumah-ibadah')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::get('/{permohonan}', 'show');
                Route::post('/{permohonan}/tolak', 'tolak');
                Route::post('/{permohonan}/terima', 'terima');
            });
        Route::controller(PermohonanRisetController::class)
            ->prefix('/permohonan-riset')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::get('/{permohonan}', 'show');
                Route::post('/{permohonan}/tolak', 'tolak');
                Route::post('/{permohonan}/terima', 'terima');
            });


        Route::controller(PengajuanCutiController::class)
            ->prefix('/pengajuan-cuti')
            ->group(function () {
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::post('/{pengajuan}/tolak', 'tolak');
                Route::post('/{pengajuan}/terima', 'terima');
            });
        Route::resource('/pengajuan-cuti', PengajuanCutiController::class)
            ->parameters([
                'pengajuan-cuti' => 'pengajuan'
            ])->except('create');

        Route::controller(PengajuanIzinController::class)
            ->prefix('/pengajuan-izin')
            ->group(function () {
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::post('/{pengajuan}/tolak', 'tolak');
                Route::post('/{pengajuan}/terima', 'terima');
            });
        Route::resource('/pengajuan-izin', PengajuanIzinController::class)
            ->parameters([
                'pengajuan-izin' => 'pengajuan'
            ])->except('create');

        Route::controller(PengajuanSPDPController::class)
            ->prefix('/pengajuan-spdp')
            ->group(function () {
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::get('/{pengajuan}/spdp', 'spdp');
                Route::post('/{pengajuan}/verifikasi', 'verifikasi');
            });
        Route::resource('/pengajuan-spdp', PengajuanSPDPController::class)
            ->parameters(['pengajuan-spdp' => 'pengajuan'])
            ->except('create');

        Route::controller(PengajuanFasilitasController::class)
            ->prefix('/pengajuan-fasilitas')
            ->group(function () {
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::post('/{pengajuan}/tolak', 'tolak');
                Route::post('/{pengajuan}/terima', 'terima');
            });
        Route::resource('/pengajuan-fasilitas', PengajuanFasilitasController::class)
            ->parameters(['pengajuan-fasilitas' => 'pengajuan'])
            ->except('create');
    });

    Route::prefix(UserStatus::PEGAWAI->route())->group(function () {
        Route::get('/', [DashboardController::class, 'pegawai']);
        Route::resource('/pengajuan-cuti', PengajuanCutiController::class)
            ->parameters(['pengajuan-cuti' => 'pengajuan']);

        Route::resource('/pengajuan-izin', PengajuanIzinController::class)
            ->parameters(['pengajuan-izin' => 'pengajuan']);

        Route::resource('/pengajuan-fasilitas', PengajuanFasilitasController::class)
            ->parameters(['pengajuan-fasilitas' => 'pengajuan']);

        Route::controller(PengajuanSPDPController::class)
            ->prefix('/pengajuan-spdp')
            ->group(function () {
                Route::get('/{pengajuan}/spdp', 'spdp');
            });
        Route::resource('/pengajuan-spdp', PengajuanSPDPController::class)
            ->parameters(['pengajuan-spdp' => 'pengajuan']);
    });

    Route::prefix(UserStatus::PIMPINAN->route())->group(function () {
        Route::get('/', [DashboardController::class, 'pimpinan']);

        Route::controller(PermohonanMagangPKLController::class)
            ->prefix('/permohonan-magang-pkl')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::get('/{permohonan}', 'show');
                Route::post('/{permohonan}/tolak', 'tolak');
                Route::post('/{permohonan}/terima', 'terima');
            });

        Route::controller(PengajuanIzinController::class)
            ->prefix('/pengajuan-izin')
            ->group(function () {
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::post('/{pengajuan}/tolak', 'tolak');
                Route::post('/{pengajuan}/terima', 'terima');
            });
        Route::resource('/pengajuan-izin', PengajuanIzinController::class)
            ->parameters([
                'pengajuan-izin' => 'pengajuan'
            ])->except('create');

        Route::controller(PengajuanFasilitasController::class)
            ->prefix('/pengajuan-fasilitas')
            ->group(function () {
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::post('/{pengajuan}/tolak', 'tolak');
                Route::post('/{pengajuan}/terima', 'terima');
            });
        Route::resource('/pengajuan-fasilitas', PengajuanFasilitasController::class)
            ->parameters(['pengajuan-fasilitas' => 'pengajuan'])
            ->except('create');

        Route::controller(PermohonanUkurKiblatController::class)
            ->prefix('/permohonan-ukur-kiblat')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::get('/{permohonan}', 'show');
                Route::post('/{permohonan}/tolak', 'tolak');
                Route::post('/{permohonan}/terima', 'terima');
            });

        Route::controller(PermohonanPendaftaranRumahIbadahController::class)
            ->prefix('/permohonan-pendaftaran-rumah-ibadah')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::get('/{permohonan}', 'show');
                Route::post('/{permohonan}/tolak', 'tolak');
                Route::post('/{permohonan}/terima', 'terima');
            });
        Route::controller(PermohonanRisetController::class)
            ->prefix('/permohonan-riset')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::get('/{permohonan}', 'show');
                Route::post('/{permohonan}/tolak', 'tolak');
                Route::post('/{permohonan}/terima', 'terima');
            });
        Route::controller(PengajuanCutiController::class)
            ->prefix('/pengajuan-cuti')
            ->group(function () {
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::post('/{pengajuan}/tolak', 'tolak');
                Route::post('/{pengajuan}/terima', 'terima');
            });
        Route::resource('/pengajuan-cuti', PengajuanCutiController::class)
            ->parameters(['pengajuan-cuti' => 'pengajuan']);

        Route::controller(PengajuanSPDPController::class)
            ->prefix('/pengajuan-spdp')
            ->group(function () {
                Route::get('/laporan', 'laporan');
                Route::post('/laporan', 'laporan');
                Route::post('/print', 'print');
                Route::get('/{pengajuan}/spdp', 'spdp');
                Route::post('/{pengajuan}/verifikasi', 'verifikasi');
            });
        Route::resource('/pengajuan-spdp', PengajuanSPDPController::class)
            ->parameters(['pengajuan-spdp' => 'pengajuan']);
    });
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'auth']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/ganti-password', [AuthController::class, 'gantiPasswordHalaman']);
Route::post('/ganti-password', [AuthController::class, 'gantiPassword']);

Route::post('uploads/process', [UploadFileController::class, 'process']);

Route::controller(PermohonanController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/permohonan-magang-pkl', 'magangPKL');
        Route::post('/permohonan-magang-pkl', 'storeMagangPKL');
        Route::get('/permohonan-pengukuran-kiblat', 'pengukuranKiblat');
        Route::post('/permohonan-pengukuran-kiblat', 'storePengukuranKiblat');
        Route::get('/permohonan-pendaftaran-rumah-ibadah', 'pendaftaranRumahIbadah');
        Route::post('/permohonan-pendaftaran-rumah-ibadah', 'storePendaftaranRumahIbadah');
        Route::get('/permohonan-riset', 'riset');
        Route::post('/permohonan-riset', 'storeriset');
    });
