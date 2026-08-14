<?php

use App\Http\Controllers\AparatDesaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemografisController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('authcheck')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/galeri/{galeri}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    Route::get('/aparat', [AparatDesaController::class, 'index'])->name('aparat_desa.index');
    Route::get('/aparat/create', [AparatDesaController::class, 'create'])->name('aparat_desa.create');
    Route::post('/aparat', [AparatDesaController::class, 'store'])->name('aparat_desa.store');
    Route::get('/aparat/{aparat_desa}/edit', [AparatDesaController::class, 'edit'])->name('aparat_desa.edit');
    Route::put('/aparat/{aparat_desa}', [AparatDesaController::class, 'update'])->name('aparat_desa.update');
    Route::delete('/aparat/{aparat_desa}', [AparatDesaController::class, 'destroy'])->name('aparat_desa.destroy');

    Route::get('/demografis', [DemografisController::class, 'index'])->name('demografis.index');
    Route::post('/demografis/update', [DemografisController::class, 'update'])->name('demografis.update');
});

Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');