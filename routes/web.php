<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Test 404 — hapus baris ini setelah testing selesai
// Route::get('/test-404', fn() => abort(404));

// Public pages
Route::view('/', 'pages.index')->name('home');
Route::view('/programs', 'pages.programs')->name('programs');
Route::view('/contact', 'pages.contact')->name('contact');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard.index');
    })->name('dashboard');

    // Dashboard sub-pages
    Route::get('/dashboard/profile-anak', function () {
        return view('pages.dashboard.profile-anak');
    })->name('dashboard.profile-anak');

    Route::get('/dashboard/jadwal', function () {
        return view('pages.dashboard.jadwal');
    })->name('dashboard.jadwal');

    Route::get('/dashboard/absensi', function () {
        return view('pages.dashboard.absensi');
    })->name('dashboard.absensi');

    Route::get('/dashboard/pembayaran', function () {
        return view('pages.dashboard.pembayaran');
    })->name('dashboard.pembayaran');

    Route::get('/dashboard/pesan', function () {
        return view('pages.dashboard.pesan');
    })->name('dashboard.pesan');

    Route::get('/dashboard/pengaturan', function () {
        return view('pages.dashboard.pengaturan');
    })->name('dashboard.pengaturan');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
