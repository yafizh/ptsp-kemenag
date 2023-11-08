<?php

use App\Enums\User\UserStatus;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\JenisCutiController;
use App\Http\Controllers\Master\JenisKendaraanController;
use App\Http\Controllers\Master\RumahIbadahController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\Permohonan\PermohonanController;
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
    Route::prefix(UserStatus::ADMIN->route())->group(function () {
        Route::get('/', [DashboardController::class, 'admin']);
        Route::resource('pegawai', PegawaiController::class);
        Route::resource('rumah-ibadah', RumahIbadahController::class);
        Route::resource('jenis-cuti', JenisCutiController::class);
        Route::resource('jenis-kendaraan', JenisKendaraanController::class);
    });

    Route::prefix(UserStatus::PEGAWAI->route())->group(function () {
        Route::get('/', [DashboardController::class, 'pegawai']);
    });

    Route::prefix(UserStatus::PIMPIMAN->route())->group(function () {
        Route::get('/', [DashboardController::class, 'pimpinan']);
    });
});

Route::controller(PermohonanController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/permohonan-magang-pkl', 'magangPKL');
        Route::get('/permohonan-pengukuran-kiblat', 'pengukuranKiblat');
        Route::get('/permohonan-pendaftaran-rumah-ibadah', 'pendaftaranRumahIbadah');
    });
