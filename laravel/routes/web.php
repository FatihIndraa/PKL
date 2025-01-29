<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// route login
Route::get('/login',[AuthController::class,'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class,'procesLogin']);

// route register
Route::get('/register', [UserController::class, 'index'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register');

// route home halaman utama

// route dashboard
Route::middleware(['userAkses'])->group(function(){
    Route::get('/', function(){
        return view('home');
    });
    Route::get('/dashboard/data-dokter', [DokterController::class, 'dataDokter'])->name('dashboard.data-dokter');
    Route::get('/dashboard/data-pasien', [UserController::class, 'dataPasien'])->name('dashboard.data-pasien');
    Route::get('/dashboard/tambah-dokter', [DokterController::class, 'showDokterRegistrationForm'])->name('register.dokter.form');
    Route::post('/dashboard/tambah-dokter', [DokterController::class, 'store'])->name('register.dokter.submit');
    Route::get('/dashboard/tambah-rekam-medis',[RekamMedisController::class,'index']);
    Route::post('/dashboard/tambah-rekam-medis',[RekamMedisController::class,'store']);
    Route::get('/dashboard/edit-rekam-medis/{id}', [RekamMedisController::class, 'edit']);
    Route::delete('/rekam-medis/{id}', [RekamMedisController::class, 'destroy']);
    Route::put('/rekam-medis/{id}', [RekamMedisController::class, 'update']);
    Route::get('/dashboard',[RekamMedisController::class,'showRekamMedis']);
    Route::get('/dashboard/tindakan', [TindakanController::class, 'viewTindakan']);
    Route::get('/tindakan', [TindakanController::class, 'index']);
    Route::post('/tindakan', [TindakanController::class, 'store']);
    Route::get('/tindakan/check/{rekam_medis_id}', 'TindakanController@checkTindakan');
    Route::get('/tindakan/{id}/edit', [TindakanController::class, 'edit'])->name('tindakan.edit');
    Route::put('/tindakan/{id}', [TindakanController::class, 'update'])->name('tindakan.update');
    Route::delete('/tindakan/{id}', [TindakanController::class, 'destroy'])->name('tindakan.destroy');
    Route::get('/home', [AuthController::class, 'index'])->name('home');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
