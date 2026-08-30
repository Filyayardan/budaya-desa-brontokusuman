<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Route::get('/bud',function(){
//   return view('wel');
// });

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/budaya', [PageController::class, 'budaya'])->name('budaya');
Route::get('/budaya/{id}', [PageController::class, 'budayaDetail'])->name('budaya.detail');
Route::get('/budaya/kategori/{id}', [PageController::class, 'budayaByKategori'])->name('budaya.kategori');
Route::get('/acara', [PageController::class, 'acara'])->name('acara');
Route::get('/acara/{id}', [PageController::class, 'acaraDetail'])->name('acara.detail');
Route::get('/peta', [PageController::class, 'peta'])->name('peta');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/berita', [PageController::class, 'berita'])->name('berita');
Route::get('/berita/{id}', [PageController::class, 'beritaDetail'])->name('berita.detail');
Route::get('/sejarah', [PageController::class, 'sejarah'])->name('sejarah');
Route::get('/profil', [PageController::class, 'profil'])->name('profil');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');