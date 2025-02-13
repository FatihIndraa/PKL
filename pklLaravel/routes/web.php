<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminMiddleware;

// route register
Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [AuthController::class, 'register']);


// route login
Route::get('/login', function () {
    return view('login');
})->name('login');
// Proses login (POST)
Route::post('/login', [AuthController::class, 'login']);
// Menampilkan halaman utama setelah login
Route::get('/home/index', function () {
    return view('home.index');
})->middleware('auth')->name('home.index');


// Route logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// route tamu
Route::get('/', function () {
    return view('home.index'); // Tamu tetap bisa melihat halaman utama
});

// // Rute untuk admin
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
//     Route::get('/kelola-user', [AdminController::class, 'index'])->name('kelola.user');
// });

// // Rute untuk member
// Route::middleware(['auth', 'member'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     // Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan');
// });

Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

use App\Http\Middleware\CheckRole; // Pastikan middleware sudah diimport

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');
});
