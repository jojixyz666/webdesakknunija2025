<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApbdController;
use App\Http\Controllers\ProfileDesaController;
use App\Http\Controllers\DataGrafisController;
use App\Http\Controllers\WargaController;

// Public Routes
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Authentication Routes (admin login at /admin/login)
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'login']);
});

// Accessible redirect for /login regardless of session
Route::get('/login', function () {
    return auth()->check()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('login'); // points to /admin/login
});
// Keep POST /login redirecting to /admin/login for non-JS clients
Route::post('/login', function () {
    return redirect()->route('login');
})->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Convenience: /admin redirects to dashboard or login
Route::get('/admin', function () {
    return auth()->check()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('login');
})->name('admin.home');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/pengaduan/lacak', [PengaduanController::class, 'track'])->name('pengaduan.track');

Route::get('/peta', [PetaController::class, 'index'])->name('peta.index');
Route::get('/api/peta/lokasi', [PetaController::class, 'apiLokasi'])->name('api.peta.lokasi');

Route::get('/profile', [ProfileDesaController::class, 'index'])->name('profile.index');

Route::get('/transparansi', [ApbdController::class, 'index'])->name('apbd.index');
Route::get('/transparansi/{apbd}/download', [ApbdController::class, 'download'])->name('apbd.download');

Route::get('/data-grafis', [DataGrafisController::class, 'index'])->name('data-grafis.index');

// Admin Routes (Protected by auth middleware)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Berita Management
    // Normalize resource parameter name to 'berita' instead of framework-inflected 'beritum'
    Route::resourceParameters([
        'berita' => 'berita',
    ]);
    Route::resource('berita', BeritaController::class)->except(['index', 'show']);
    Route::get('/berita', [BeritaController::class, 'adminIndex'])->name('berita.index');
    
    // Pengaduan Management
    Route::get('/pengaduan', [PengaduanController::class, 'adminIndex'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::put('/pengaduan/{pengaduan}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    
    // Peta Management
    Route::get('/peta', [PetaController::class, 'adminIndex'])->name('peta.index');
    Route::get('/peta/create', [PetaController::class, 'create'])->name('peta.create');
    Route::post('/peta', [PetaController::class, 'store'])->name('peta.store');
    Route::get('/peta/{peta}/edit', [PetaController::class, 'edit'])->name('peta.edit');
    Route::put('/peta/{peta}', [PetaController::class, 'update'])->name('peta.update');
    Route::delete('/peta/{peta}', [PetaController::class, 'destroy'])->name('peta.destroy');
    
    // APBD Management
    Route::get('/apbd', [ApbdController::class, 'adminIndex'])->name('apbd.index');
    Route::get('/apbd/create', [ApbdController::class, 'create'])->name('apbd.create');
    Route::post('/apbd', [ApbdController::class, 'store'])->name('apbd.store');
    Route::get('/apbd/{apbd}/edit', [ApbdController::class, 'edit'])->name('apbd.edit');
    Route::put('/apbd/{apbd}', [ApbdController::class, 'update'])->name('apbd.update');
    Route::delete('/apbd/{apbd}', [ApbdController::class, 'destroy'])->name('apbd.destroy');
    
    // Profile Desa Management
    Route::get('/profile', [ProfileDesaController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileDesaController::class, 'update'])->name('profile.update');
    
    // Data Warga Management
    Route::resource('warga', WargaController::class);
    
    // Data Grafis Management - APBDes
    Route::get('/data-grafis/apbdes', [DataGrafisController::class, 'apbdesIndex'])->name('data-grafis.apbdes.index');
    Route::get('/data-grafis/apbdes/create', [DataGrafisController::class, 'apbdesCreate'])->name('data-grafis.apbdes.create');
    Route::post('/data-grafis/apbdes', [DataGrafisController::class, 'apbdesStore'])->name('data-grafis.apbdes.store');
    Route::get('/data-grafis/apbdes/{dataApbdes}/edit', [DataGrafisController::class, 'apbdesEdit'])->name('data-grafis.apbdes.edit');
    Route::put('/data-grafis/apbdes/{dataApbdes}', [DataGrafisController::class, 'apbdesUpdate'])->name('data-grafis.apbdes.update');
    Route::delete('/data-grafis/apbdes/{dataApbdes}', [DataGrafisController::class, 'apbdesDestroy'])->name('data-grafis.apbdes.destroy');
    
    // Pengaturan
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});
