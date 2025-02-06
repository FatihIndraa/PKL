<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// route register
Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [AuthController::class, 'register']);

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

Route::get('/', function () {
    return view('home.index'); // Tamu tetap bisa melihat halaman utama
});

Route::get('/admin', function () {
    return 'Halo Admin';
})->middleware('userAkses');
