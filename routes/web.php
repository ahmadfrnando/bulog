<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KomoditasController;
use App\Http\Controllers\Admin\PasarController;
use App\Http\Controllers\Admin\PenugasanPasarController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\RekapitulasiBulananController;
use App\Http\Controllers\Admin\RekapitulasiHarianController;
use App\Http\Controllers\Admin\SubmisiHargaController;
use App\Http\Controllers\Petugas\SubmisiHargaController as PetugasSubmisiHargaController;
use App\Http\Controllers\Admin\TokoController;
use App\Http\Controllers\Petugas\UserController as PetugasUserController;
use App\Http\Controllers\AjaxLoadController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
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
    return view('welcome');
});

//ajax controller
Route::get('/search-pasar', [AjaxLoadController::class, 'getPasar'])->name('search.pasar');
Route::get('/search-petugas', [AjaxLoadController::class, 'getPetugas'])->name('search.petugas');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('petugas', PetugasController::class);
    Route::resource('pasar', PasarController::class);
    Route::resource('penugasan-pasar', PenugasanPasarController::class);
    Route::resource('komoditas', KomoditasController::class);
    Route::resource('submisi-harga', SubmisiHargaController::class);
    Route::put('submisi-harga/{submisi_harga}/status', [SubmisiHargaController::class, 'updateStatus'])->name('submisi-harga.status');
    Route::get('submisi-harga/{submisi_harga}/riwayat-status', [SubmisiHargaController::class, 'getRiwayatStatus'])
    ->name('submisi-harga.riwayat');
    Route::resource('rekapitulasi-harian', RekapitulasiHarianController::class);
    Route::resource('rekapitulasi-bulanan', RekapitulasiBulananController::class);
});
Route::middleware(['auth', 'role:petugas'])->name('petugas.')->prefix('petugas')->group(function () {
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
    Route::put('/ubah-password', [PetugasUserController::class, 'ubahPassword'])->name('user.change-password');
    Route::resource('submisi-harga', PetugasSubmisiHargaController::class);
});
