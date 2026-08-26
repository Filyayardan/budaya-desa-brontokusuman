<?php

use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriBudayaController;
use App\Http\Controllers\Admin\BudayaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\AcaraController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\ProfilKampungController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UmkmController;

Route::prefix('admin')->middleware('web')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route::middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kategori-budaya', KategoriBudayaController::class)->except(['show']);
    Route::resource('budaya', BudayaController::class)->except(['show']);
    Route::resource('umkm', UmkmController::class)->except(['show']);
    Route::resource('berita', BeritaController::class)->except(['show'])->parameters(['berita' => 'berita']);
    Route::resource('acara', AcaraController::class)->except(['show']);
    Route::resource('galeri', GaleriController::class)->except(['show']);
    Route::resource('sejarah', SejarahController::class)->except(['show']);
    Route::resource('pengurus', PengurusController::class)->except(['show'])->parameters(['pengurus' => 'pengurus']);
    Route::resource('banner', BannerController::class)->except(['show']);
    Route::resource('pengunjung', VisitorController::class)->except(['show']);

    Route::get('/profil', [ProfilKampungController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfilKampungController::class, 'update'])->name('profil.update');
    // });
});
