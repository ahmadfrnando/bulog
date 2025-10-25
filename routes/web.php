<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PasarController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\TokoController;
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('petugas', PetugasController::class);
    Route::resource('pasar', PasarController::class);
    Route::resource('pasar.toko', TokoController::class);

    // Route::get('/pasar/{pasar}/toko', [TokoController::class, 'index'])->name('toko.index');
    // Route::get('/pasar/{pasar}/toko/create', [TokoController::class, 'create'])->name('toko.create');
    // Route::get('/pasar/{pasar}/toko/{toko}/edit', [TokoController::class, 'edit'])->name('toko.edit');
    // Route::post('/pasar/{pasar}/toko/{toko}', [TokoController::class, 'store'])->name('toko.store');
    // Route::put('/pasar/{pasar}/toko/{toko}', [TokoController::class, 'edit'])->name('toko.update');
    // Route::delete('/pasar/{pasar}/toko/{toko}', [TokoController::class, 'destroy'])->name('toko.destroy');
});
Route::middleware(['auth', 'role:petugas'])->name('petugas.')->prefix('petugas')->group(function () {
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
});