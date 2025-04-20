<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\RattingController;

// Route untuk register
Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [AuthController::class, 'register']);

// Route untuk login
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);


// Route untuk logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk tamu & member: halaman utama dengan daftar paket
Route::get('/', [PaketController::class, 'tampilPaket'])->name('home');

// Route untuk admin
Route::middleware(['auth', 'userAkses:admin'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/paket', [PaketController::class, 'index'])->name('paket.index');
    Route::get('/paket/create', [PaketController::class, 'create'])->name('paket.create');
    Route::post('/paket', [PaketController::class, 'store'])->name('paket.store');
    Route::get('/paket/{id}/edit', [PaketController::class, 'edit'])->name('paket.edit');
    Route::get('/admin/ratting', [DashboardController::class, 'ratting'])->name('ratting');

    // Route untuk update paket
    Route::put('/paket/{id}', [PaketController::class, 'update'])->name('paket.update');

    // Jika ingin alternatif POST (misalnya untuk AJAX)
    Route::post('/paket/{id}/update', [PaketController::class, 'update'])->name('paket.postUpdate');

    Route::delete('/paket/{id}', [PaketController::class, 'destroy'])->name('paket.destroy');

    // Dashboard admin untuk paket
    Route::get('/dashboard/paket', [DashboardController::class, 'paket'])->name('dashboard.paket');

    Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/create', [UserController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna', [UserController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{id}/edit', [UserController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}', [UserController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [UserController::class, 'destroy'])->name('pengguna.destroy');

    Route::get('/dashboard/pemesanan', [PemesananController::class, 'index'])->name('dashboard.pemesanan.index');
    Route::post('/dashboard/pemesanan/{id}/approve', [PemesananController::class, 'approve'])->name('dashboard.pemesanan.approve');
    Route::post('/dashboard/pemesanan/{id}/complete', [PemesananController::class, 'complete'])->name('dashboard.pemesanan.complete');
    Route::post('/dashboard/pemesanan/{id}/updateStatus', [PemesananController::class, 'updateStatus'])->name('dashboard.pemesanan.updateStatus');
    Route::post('/dashboard/pemesanan/{id}/updateSelesai', [PemesananController::class, 'updateSelesai'])->name('dashboard.pemesanan.updateSelesai');
    Route::put('/dashboard/pemesanan/{id}/update', [PemesananController::class, 'update'])->name('dashboard.pemesanan.update');
    Route::delete('/dashboard/pemesanan/{id}', [PemesananController::class, 'destroy'])->name('dashboard.pemesanan.destroy');
    Route::post('/dashboard/pemesanan', [PemesananController::class, 'storeAdmin'])->name('dashboard.pemesanan.store');
});

// Route untuk member
Route::middleware(['auth', 'userAkses:member'])->group(function () {
    Route::get('/dashboard/member', [DashboardController::class, 'index'])->name('dashboard.member');
});

// Route untuk semua user yang login (member & admin bisa pesan)
Route::middleware(['auth'])->group(function () {
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('/pembayaran/{id}', [PemesananController::class, 'pembayaran'])->name('pembayaran.show');
    Route::post('/pembayaran/{id}', [PemesananController::class, 'uploadBukti'])->name('pembayaran.upload');
    Route::get('/dashboard/pemesanan', [PemesananController::class, 'index'])->name('dashboard.pemesanan.index');
    Route::get('/ratting', [RattingController::class, 'index'])->name('ratting.index');
    Route::post('/ratting', [RattingController::class, 'store'])->name('ratting.store');
});

Route::post('/dashboard/pemesanan/{id}/upload-bukti', [PemesananController::class, 'uploadBukti'])
    ->name('dashboard.pemesanan.uploadBukti')
    ->middleware('auth');


