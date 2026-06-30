<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\ProjectAsset;
use Illuminate\Http\Request;
use Barrier\DomPDF\Facade\Pdf; // <--- PASTIKAN library dompdf di-import dengan benar jika menggunakan alias alias 'Pdf' bawaan Barryvdh
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf; // Mengamankan pemanggilan class Pdf
use App\Models\User;

class AssetAdminController extends Controller
{
    // Tampilan Utama File & Asset Admin
    public function index()
    {
        // Mengambil daftar transaksi yang berstatus PAID/sukses beserta data user & layanannya
        $activeProjects = Transaction::with(['user', 'layanan'])
                            ->whereIn('status', ['PAID', 'SETTLED'])
                            ->get();

        return view('FileAsset', compact('activeProjects'));
    }

    // Ambil daftar file berdasarkan Transaction ID (API)
    public function getAssets($transactionId)
    {
        $assets = ProjectAsset::where('transaction_id', $transactionId)->orderBy('created_at', 'desc')->get();
        return response()->json($assets);
    }

    // Proses unggah file dari Admin ke Project Client
    public function upload(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'file' => 'required|file|max:51200' // Maksimal 50MB per berkas berkontrak
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            
            // Format kalkulasi ukuran file
            $sizeInBytes = $file->getSize();
            $fileSize = round($sizeInBytes / 1024 / 1024, 2) . ' MB';
            if ($sizeInBytes < 1048576) {
                $fileSize = round($sizeInBytes / 1024, 2) . ' KB';
            }

            // Simpan ke direktori: storage/app/public/assets
            $path = $file->store('assets', 'public');

            $asset = ProjectAsset::create([
                'transaction_id' => $request->transaction_id,
                'file_name' => $originalName,
                'file_path' => $path,
                'file_size' => $fileSize
            ]);

            return response()->json(['status' => 'success', 'data' => $asset]);
        }

        return response()->json(['status' => 'error', 'message' => 'Berkas tidak ditemukan.'], 400);
    }

    // ================= TAMBAHAN BARU: MANAJEMEN INVOICE SISI ADMIN =================

    /**
     * Menampilkan halaman daftar semua transaksi lunas untuk Admin
     */
    public function transactionIndex()
    {
        // Mengambil semua transaksi lunas beserta data user dan jenis layanannya
        $transactions = Transaction::with(['user', 'layanan'])
                            ->whereIn('status', ['PAID', 'SETTLED'])
                            ->orderBy('updated_at', 'desc')
                            ->get();

        return view('TransactionAdmin', compact('transactions'));
    }

    /**
     * Admin mendownload invoice PDF berdasarkan ID Transaksi Proyek
     */
    public function adminDownloadInvoice($id)
    {
        // Cari transaksi lunas (admin bebas mengunduh tanpa batasan kepemilikan User_ID)
        $transaction = Transaction::with(['user', 'layanan'])
                            ->where('id', $id)
                            ->whereIn('status', ['PAID', 'SETTLED'])
                            ->firstOrFail();

        // Mengatur susunan nomor invoice agar sinkron dengan ID Proyek
        $invoiceNo = 'INV-' . str_pad($transaction->id, 4, '0', STR_PAD_LEFT);

        // Load HTML template netral abu-abu minimalis yang sama dengan client
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoice-pdf', compact('transaction', 'invoiceNo'));

        // Unduh instan file PDF ke folder download browser
        return $pdf->download($invoiceNo . '.pdf');
    }

    public function userIndex()
{
    // Mengambil semua user dengan role 'user' atau urutkan berdasarkan yang terbaru
    $users = User::orderBy('User_ID', 'desc')->get();

    return view('UserAdmin', compact('users'));
}

/**
 * Menghapus akun user berdasarkan User_ID
 */
public function userDestroy($id)
{
    // Cari user berdasarkan User_ID primary key Anda
    $user = User::where('User_ID', $id)->firstOrFail();
    
    // Cegah admin menghapus dirinya sendiri jika tidak sengaja
    if ($user->User_ID == auth()->user()->User_ID) {
        return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
    }

    $user->delete();

    return redirect()->back()->with('success', 'Akun user berhasil dihapus permanen.');
}

public function projectIndex()
{
    // Mengambil semua transaksi lunas/proses untuk dikelola progress proyeknya
    $projects = Transaction::with(['user', 'layanan'])
                    ->whereIn('status', ['PAID', 'SETTLED', 'PENDING'])
                    ->orderBy('updated_at', 'desc')
                    ->get();

    return view('ProjectAdmin', compact('projects'));
}

/**
 * Memperbarui persentase progress proyek oleh Admin
 */
public function updateProgress(Request $request, $id)
{
    $request->validate([
        'progress' => 'required|integer|min:0|max:100'
    ]);

    $project = Transaction::findOrFail($id);
    $project->progress = $request->progress;
    $project->save();

    return redirect()->back()->with('success', 'Progress proyek #' . str_pad($project->id, 4, '0', STR_PAD_LEFT) . ' berhasil diperbarui menjadi ' . $request->progress . '%!');
}


}