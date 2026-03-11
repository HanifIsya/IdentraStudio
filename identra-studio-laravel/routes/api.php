<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PembayaranController;

/*
|--------------------------------------------------------------------------
| API Routes - identra-studio-laravel
|--------------------------------------------------------------------------
*/

// =====================
//  AUTH (Public)
// =====================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// =====================
//  PROTECTED ROUTES
// =====================
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    // Layanan (CRUD)
    Route::apiResource('layanans', LayananController::class);

    // Pesanan (CRUD)
    Route::apiResource('pesanans', PesananController::class);

    // Pembayaran (CRUD)
    Route::apiResource('pembayarans', PembayaranController::class);
});
