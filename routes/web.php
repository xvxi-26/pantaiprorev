<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Controllers\BudayaController;
use App\Http\Controllers\ProfileController;

// Admin login routes
Route::get('/admin/login', [AuthController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Dashboard route (protected)

Route::middleware([AdminAuthenticate::class])
    ->prefix('admin')
    ->group(function () {
Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::resource('pengunjung', PengunjungController::class);
Route::resource('wisata', WisataController::Class);
Route::resource('budaya', BudayaController::class);
Route::resource('profile', ProfileController::class);
Route::get('pengunjung/{id}/kunjungan', [PengunjungController::class, 'tambahKunjunganForm'])->name('pengunjung.kunjungan');
Route::post('pengunjung/{id}/kunjungan-store', [PengunjungController::class, 'simpanKunjungan'])->name('pengunjung.kunjungan.store');
Route::get('laporan-pengunjung', [AdminController::class, 'laporanForm'])->name('admin.laporan.form');
Route::get('laporan-pengunjung/download', [AdminController::class, 'cetakLaporan'])->name('admin.laporan.cetak');
Route::get('/wisata/{wisata}/galeri/create', [GaleriController::class, 'create'])->name('wisata.galeri.create');
    Route::post('wisata/{wisata}/galeri/store', [GaleriController::class, 'store'])->name('wisata.galeri.store');
    Route::get('wisata/{wisata}/galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('wisata.galeri.edit');
    Route::put('wisata/{wisata}/galeri/{galeri}', [GaleriController::class, 'update'])->name('wisata.galeri.update');
    Route::delete('wisata/{wisata}/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('wisata.galeri.destroy');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home/wisata/{id}', [HomeController::class, 'show'])->name('wisata.detail');
Route::get('/budaya/{id}', [HomeController::class, 'showBudaya'])->name('budayafront.show');
