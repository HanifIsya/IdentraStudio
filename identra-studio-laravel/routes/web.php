<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Models\Layanan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Identra Studio
|--------------------------------------------------------------------------
*/

// Halaman Public
Route::get('/', function () {
    return view('home');
})->name('home');

// GUEST ONLY (Login & Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// AUTH ONLY (Halaman yang butuh Login)
Route::middleware('auth')->group(function () {
    
    // Dashboard: Mengambil 6 layanan pertama untuk preview
    Route::get('/dashboard', function () {
        $layanans = Layanan::take(6)->get();
        return view('DashboardUser', compact('layanans'));
    })->name('dashboard');

    // Layanan: Menampilkan semua layanan dari database
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});