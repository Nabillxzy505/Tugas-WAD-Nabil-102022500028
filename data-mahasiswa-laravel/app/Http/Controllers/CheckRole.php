<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('mahasiswa.index'));

// Login & logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Modul Data Mahasiswa: harus login, lalu dibatasi menurut peran
Route::middleware('auth')->group(function () {

    // Lihat daftar: admin dan dosen
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])
        ->middleware('role:admin,dosen')
        ->name('mahasiswa.index');

    // Tambah, ubah, hapus: hanya admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class)->except(['index', 'show']);
    });
});