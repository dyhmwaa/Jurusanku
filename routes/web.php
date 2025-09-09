<?php

use App\Http\Controllers\KonsultasiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Rute untuk landing page
Route::get('/', function () {
    return view('konsultasi.landing'); // Ini mengarah ke resources/views/konsultasi/landing.blade.php
})->name('landing');

// Rute untuk konsultasi jurusan (publik)
Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi');
Route::post('/konsultasi', [KonsultasiController::class, 'store'])->name('konsultasi.store');
Route::get('/hasil/{id}', [KonsultasiController::class, 'show'])->name('konsultasi.hasil');

// Rute yang dilindungi (memerlukan otentikasi)
Route::middleware(['auth'])->group(function () {
    Route::get('/data', [KonsultasiController::class, 'data'])->name('konsultasi.data');
    Route::delete('/data/{id}', [KonsultasiController::class, 'destroy'])->name('konsultasi.destroy');
});

// Redirect /home ke /konsultasi/data untuk pengguna yang telah diautentikasi
Route::get('/home', function () {
    return redirect()->route('konsultasi.data');
})->name('home');

// Rute autentikasi
Auth::routes([
    'register' => false, // Matikan registrasi jika hanya admin yang boleh login
    'reset' => true,
    'verify' => false,
]);

Route::get('/data/download', [KonsultasiController::class, 'download'])->name('data.download');
