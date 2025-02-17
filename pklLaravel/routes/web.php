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

Route::middleware(['auth', 'userAkses:admin'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
});

Route::middleware(['auth', 'userAkses:member'])->group(function () {
    Route::get('/dashboard/member', [DashboardController::class, 'index'])->name('dashboard.member');
});