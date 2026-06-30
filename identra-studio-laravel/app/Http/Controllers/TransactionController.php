<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Pdf; // Menggunakan Facade dari barryvdh/laravel-dompdf

class TransactionController extends Controller
{
    /**
     * Menampilkan halaman riwayat transaksi di sisi user/customer
     */
    public function index()
    {
        // PERBAIKAN FATAL: Memakai User_ID sesuai dengan Primary Key tabel users Anda
        $transactions = Transaction::with(['layanan'])
                            ->where('user_id', Auth::user()->User_ID) 
                            ->whereIn('status', ['PAID', 'SETTLED']) // Hanya menampilkan yang sudah lunas
                            ->orderBy('updated_at', 'desc')
                            ->get();

        return view('transaction', compact('transactions'));
    }

    /**
     * Fungsi untuk men-generate dan mengunduh berkas Invoice PDF
     */
    public function downloadInvoice($id)
    {
        // Proteksi keamanan: pastikan transaksi ini benar-benar milik user yang sedang login
        $transaction = Transaction::with(['user', 'layanan'])
                            ->where('user_id', Auth::user()->User_ID)
                            ->where('id', $id)
                            ->whereIn('status', ['PAID', 'SETTLED'])
                            ->firstOrFail();

        // Membuat format Nomor Invoice dinamis dan rapi
        $invoiceNo = 'INV-' . str_pad($transaction->id, 4, '0', STR_PAD_LEFT);

        // Melempar data ke template PDF native
        $pdf = Pdf::loadView('invoice-pdf', compact('transaction', 'invoiceNo'));

        // Memaksa browser untuk langsung mengunduh berkas PDF
        return $pdf->download($invoiceNo . '.pdf');
    }
}