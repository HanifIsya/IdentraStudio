<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes - Identra Studio
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN PUBLIK ---
Route::get('/', function () {
    return view('home');
})->name('home');


// --- 2. GUEST ONLY (Hanya bisa diakses jika BELUM login) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


// --- 3. AUTH ONLY (Harus login, bisa User biasa atau Admin) ---
Route::middleware('auth')->group(function () {
    
    // Dashboard User: Mengambil 6 layanan pertama untuk preview
    Route::get('/dashboard', function () {
        $layanans = Layanan::take(6)->get();
        return view('DashboardUser', compact('layanans'));
    })->name('dashboard');

    // Halaman Layanan User: Menampilkan semua layanan dari database
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');

    // --- FITUR BARU: Keranjang Belanja (Cart) ---
    // Mengarahkan ke resources/views/cart.blade.php
    Route::get('/cart', function () {
        return view('cart');
    })->name('cart');

    // Proses Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// --- 4. ADMIN ONLY (Harus login DAN memiliki role 'admin') ---
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    // Dashboard Utama Admin
    Route::get('/dashboard', function () {
        $stats = [
            'total_user' => User::count(),
            'total_order' => 85, 
            'total_revenue' => 'Rp 25.000.000'
        ];
        return view('DashboardAdmin', compact('stats'));
    })->name('admin.dashboard');

    // CRUD Layanan Admin
    Route::resource('layanan', LayananAdminController::class)->names([
        'index' => 'admin.layanan.index',
        'create' => 'admin.layanan.create',
        'store' => 'admin.layanan.store',
        'edit' => 'admin.layanan.edit',
        'update' => 'admin.layanan.update',
        'destroy' => 'admin.layanan.destroy',
    ]);
});