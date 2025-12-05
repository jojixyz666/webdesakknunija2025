<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\AuthController;

// Public Routes
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/pengaduan/lacak', [PengaduanController::class, 'track'])->name('pengaduan.track');

Route::get('/peta', [PetaController::class, 'index'])->name('peta.index');
Route::get('/api/peta/lokasi', [PetaController::class, 'apiLokasi'])->name('api.peta.lokasi');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');

// Admin Routes (Protected by auth middleware)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Berita Management
    Route::resource('berita', BeritaController::class)->except(['index', 'show']);
    Route::get('/berita', [BeritaController::class, 'adminIndex'])->name('berita.index');
    
    // Pengaduan Management
    Route::get('/pengaduan', [PengaduanController::class, 'adminIndex'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::put('/pengaduan/{pengaduan}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    
    // Peta Management
    Route::resource('peta', PetaController::class)->except(['index', 'show']);
    Route::get('/peta', [PetaController::class, 'adminIndex'])->name('peta.index');
    
    // Galeri Management
    Route::resource('galeri', GaleriController::class)->except(['index']);
    Route::get('/galeri', [GaleriController::class, 'adminIndex'])->name('galeri.index');
    
    // Pengaturan
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});
