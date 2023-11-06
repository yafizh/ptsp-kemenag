<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\JenisCutiController;
use App\Http\Controllers\Master\JenisKendaraanController;
use App\Http\Controllers\Master\RumahIbadahController;
use App\Http\Controllers\PegawaiController;
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

Route::get('/', function () {
    // return view('dashboard.index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'auth']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'admin']);
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('rumah-ibadah', RumahIbadahController::class);
    Route::resource('jenis-cuti', JenisCutiController::class);
    Route::resource('jenis-kendaraan', JenisKendaraanController::class);
});
