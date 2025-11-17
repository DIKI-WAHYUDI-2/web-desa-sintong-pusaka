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

    Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    Route::get('/aparat', [AparatDesaController::class, 'index'])->name('aparat');
    Route::get('/aparat/create', [AparatDesaController::class, 'create'])->name('aparat.create');
    Route::post('/aparat', [AparatDesaController::class, 'store'])->name('aparat.store');
    Route::get('/aparat/{id}/edit', [AparatDesaController::class, 'edit'])->name('aparat.edit');
    Route::put('/aparat/{id}', [AparatDesaController::class, 'update'])->name('aparat.update');
    Route::delete('/aparat/{id}', [AparatDesaController::class, 'destroy'])->name('aparat.destroy');

    Route::get('/demografis', [DemografisController::class, 'index'])->name('demografis');
    Route::post('/demografis/update', [DemografisController::class, 'update'])->name('demografis.update');
});

Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
