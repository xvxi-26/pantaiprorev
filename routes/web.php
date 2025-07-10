<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\PengunjungController;

Route::group(['prefix' => 'admin',], function () {
Route::resource('pengunjung', PengunjungController::class);
Route::resource('wisata', WisataController::Class);
Route::get('/wisata/{wisata}/galeri/create', [GaleriController::class, 'create'])->name('wisata.galeri.create');
    Route::post('wisata/{wisata}/galeri/store', [GaleriController::class, 'store'])->name('wisata.galeri.store');
    Route::get('wisata/{wisata}/galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('wisata.galeri.edit');
    Route::put('wisata/{wisata}/galeri/{galeri}', [GaleriController::class, 'update'])->name('wisata.galeri.update');
    Route::delete('wisata/{wisata}/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('wisata.galeri.destroy');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home/wisata/{id}', [HomeController::class, 'show'])->name('wisata.detail');
