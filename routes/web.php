<?php

use App\Enums\User\UserStatus;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\JenisCutiController;
use App\Http\Controllers\Master\JenisKendaraanController;
use App\Http\Controllers\Master\RumahIbadahController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\Pengajuan\PengajuanCutiController;
use App\Http\Controllers\Permohonan\PermohonanController;
use App\Http\Controllers\Permohonan\PermohonanMagangPKLController;
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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'auth']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::post('uploads/process', [UploadFileController::class, 'process']);

    Route::prefix(UserStatus::ADMIN->route())->group(function () {
        Route::get('/', [DashboardController::class, 'admin']);
        Route::resource('pegawai', PegawaiController::class);
        Route::resource('rumah-ibadah', RumahIbadahController::class);
        Route::resource('jenis-cuti', JenisCutiController::class);
        Route::resource('jenis-kendaraan', JenisKendaraanController::class);

        Route::controller(PermohonanMagangPKLController::class)->group(function () {
            Route::get('/permohonan-magang-pkl', 'index');
            Route::get('/permohonan-magang-pkl/{permohonan}', 'show');
            Route::post('/permohonan-magang-pkl/{permohonan}/tolak', 'tolak');
            Route::post('/permohonan-magang-pkl/{permohonan}/terima', 'terima');
        });

        Route::resource('/pengajuan-cuti', PengajuanCutiController::class)
            ->parameters([
                'pengajuan-cuti' => 'pengajuan'
            ])->except('create');
        Route::controller(PengajuanCutiController::class)
            ->prefix('/pengajuan-cuti')
            ->group(function () {
                Route::post('/{pengajuan}/tolak', 'tolak');
                Route::post('/{pengajuan}/terima', 'terima');
            });
    });

    Route::prefix(UserStatus::PEGAWAI->route())->group(function () {
        Route::get('/', [DashboardController::class, 'pegawai']);

        Route::resource('/pengajuan-cuti', PengajuanCutiController::class)
            ->parameters([
                'pengajuan-cuti' => 'pengajuan'
            ]);
    });

    Route::prefix(UserStatus::PIMPINAN->route())->group(function () {
        Route::get('/', [DashboardController::class, 'pimpinan']);
        Route::controller(PermohonanMagangPKLController::class)->group(function () {
            Route::get('/permohonan-magang-pkl', 'index');
            Route::get('/permohonan-magang-pkl/{permohonan}', 'show');
            Route::post('/permohonan-magang-pkl/{permohonan}/tolak', 'tolak');
            Route::post('/permohonan-magang-pkl/{permohonan}/terima', 'terima');
        });

        Route::resource('/pengajuan-cuti', PengajuanCutiController::class)
            ->parameters([
                'pengajuan-cuti' => 'pengajuan'
            ]);
        Route::controller(PengajuanCutiController::class)
            ->prefix('/pengajuan-cuti')
            ->group(function () {
                Route::post('/{pengajuan}/tolak', 'tolak');
                Route::post('/{pengajuan}/terima', 'terima');
            });
    });
});

Route::controller(PermohonanController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/permohonan-magang-pkl', 'magangPKL');
        Route::post('/permohonan-magang-pkl', 'storeMagangPKL');
        Route::get('/permohonan-pengukuran-kiblat', 'pengukuranKiblat');
        Route::get('/permohonan-pendaftaran-rumah-ibadah', 'pendaftaranRumahIbadah');
    });
