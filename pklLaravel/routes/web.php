<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaketController;

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
    Route::post('/paket', [PaketController::class, 'store'])->name('paket.store'); // Route untuk menyimpan paket

    // Dashboard admin untuk paket
    Route::get('/dashboard/paket', [DashboardController::class, 'paket'])->name('dashboard.paket');
});

// Route untuk member
Route::middleware(['auth', 'userAkses:member'])->group(function () {
    Route::get('/dashboard/member', [DashboardController::class, 'index'])->name('dashboard.member');
});
