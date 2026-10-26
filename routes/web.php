<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

// Halaman awal diarahkan ke daftar mahasiswa
Route::get('/', fn () => redirect()->route('mahasiswa.index'));

Route::resource('mahasiswa', MahasiswaController::class)->except(['show']);