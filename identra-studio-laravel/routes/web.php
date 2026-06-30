<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananAdminController;
use App\Http\Controllers\PaymentController; 
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AssetAdminController; 
use App\Http\Controllers\TransactionController; 

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

    // --- Keranjang Belanja (Cart) ---
    Route::get('/cart', function () {
        return view('cart');
    })->name('cart');

    // --- Xendit Payment Gateway Token ---
    Route::post('/payment/snap-token', [PaymentController::class, 'getSnapToken'])->name('payment.snap');

    // --- Fitur Chat & Koordinasi Proyek Disesuaikan Per Room Proyek ---
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/api/messages/{transactionId?}', [ChatController::class, 'getMessages']); 
    Route::post('/api/messages', [ChatController::class, 'sendMessage']);

    // --- API Fetch Project Assets untuk Tampilan Side Client ---
    Route::get('/api/project-assets/{transactionId}', [AssetAdminController::class, 'getAssets']);

    // --- Riwayat Transaksi & Cetak Invoice Client ---
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transactions/invoice/{id}', [TransactionController::class, 'downloadInvoice'])->name('transaction.download-invoice');

    // --- Rute Tracking Real Database (Multi-Room) ---
    Route::get('/tracking', function () {
        $allTransactions = \App\Models\Transaction::with('layanan')
                        ->where('user_id', auth()->user()->User_ID)
                        ->whereIn('status', ['PAID', 'SETTLED', 'PENDING'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        $hasPurchased = !$allTransactions->isEmpty();

        return view('TrackingProject', compact('hasPurchased', 'allTransactions'));
    })->name('project.tracking');

    // --- API Fetch Detail Progress Transaksi Spesifik saat Room diklik ---
    Route::get('/api/tracking/detail/{id}', function ($id) {
        $transaction = \App\Models\Transaction::with('layanan')
                        ->where('user_id', auth()->user()->User_ID)
                        ->where('id', $id)
                        ->firstOrFail();
                        
        return response()->json($transaction);
    });

    // Proses Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// --- 4. ADMIN ONLY (Harus login DAN memiliki role 'admin') ---
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    // PERBAIKAN: Dashboard Utama Admin Dinamis (Tidak Hardcoded)
    Route::get('/dashboard', function () {
        // 1. Hitung agregasi statistik riil dari database
        $stats = [
            'total_user'    => User::where('role', 'user')->count(),
            'total_order'   => \App\Models\Transaction::whereIn('status', ['PAID', 'SETTLED'])->count(), 
            'total_revenue' => \App\Models\Transaction::whereIn('status', ['PAID', 'SETTLED'])->sum('amount')
        ];

        // 2. Mengambil 5 project client aktif terbaru untuk tabel utama
        $recentProjects = \App\Models\Transaction::with(['user', 'layanan'])
                            ->whereIn('status', ['PAID', 'SETTLED', 'PENDING'])
                            ->orderBy('updated_at', 'desc')
                            ->take(5)
                            ->get();

        // 3. Mengambil 4 room proyek aktif teratas untuk widget chat box samping
        $recentChats = \App\Models\Transaction::with(['user', 'layanan'])
                            ->whereIn('status', ['PAID', 'SETTLED', 'PENDING'])
                            ->orderBy('updated_at', 'desc')
                            ->take(4)
                            ->get();

        // 4. Mengambil 4 aset berkas produksi digital paling akhir diunggah
        $recentFiles = \App\Models\ProjectAsset::orderBy('created_at', 'desc')
                            ->take(4)
                            ->get();

        return view('DashboardAdmin', compact('stats', 'recentProjects', 'recentChats', 'recentFiles'));
    })->name('admin.dashboard');

    // Halaman Manajemen Transaksi & Invoice Admin
    Route::get('/transactions', [AssetAdminController::class, 'transactionIndex'])->name('admin.transaction.index');
    Route::get('/transactions/invoice/{id}', [AssetAdminController::class, 'adminDownloadInvoice'])->name('admin.transaction.download-invoice');

    // CRUD Layanan Admin
    Route::resource('layanan', LayananAdminController::class)->names([
        'index' => 'admin.layanan.index',
        'create' => 'admin.layanan.create',
        'store' => 'admin.layanan.store',
        'edit' => 'admin.layanan.edit',
        'update' => 'admin.layanan.update',
        'destroy' => 'admin.layanan.destroy',
    ]);

    // --- Manajemen File & Asset Admin ---
    Route::get('/file-asset', [AssetAdminController::class, 'index'])->name('admin.asset.index');
    Route::post('/api/file-asset/upload', [AssetAdminController::class, 'upload']);

    // Halaman User Management Admin
    Route::get('/users', [AssetAdminController::class, 'userIndex'])->name('admin.user.index');
    Route::delete('/users/{id}', [AssetAdminController::class, 'userDestroy'])->name('admin.user.destroy');

    // Halaman Manajemen Project Client Admin (Update Progress Bar)
    Route::get('/projects', [AssetAdminController::class, 'projectIndex'])->name('admin.project.index');
    Route::post('/projects/{id}/update-progress', [AssetAdminController::class, 'updateProgress'])->name('admin.project.update-progress');
});