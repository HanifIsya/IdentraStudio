<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

class PaymentController extends Controller
{
    public function getSnapToken(Request $request)
    {
        // 1. Ambil total harga dari request frontend
        $totalHarga = $request->input('total_harga');

        if (!$totalHarga || $totalHarga <= 0) {
            return response()->json(['error' => 'Keranjang kosong atau nominal salah'], 400);
        }

        // 2. Solusi Tepat SDK v3: Set API Key secara global pada properti statis Configuration
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

        // 3. Buat instance InvoiceApi tanpa mengoper objek config ke constructor-nya
        $apiInstance = new InvoiceApi();

        // 4. Susun parameter request invoice
        $createInvoiceRequest = new CreateInvoiceRequest([
            'external_id' => 'IDENTRA-' . time(),
            'amount' => (double) $totalHarga,
            'description' => 'Pembayaran Jasa Pembuatan Website - Identra Studio',
            'invoice_duration' => 86400,
            'success_redirect_url' => url('/tracking'),
            'failure_redirect_url' => url('/cart'),
            'customer' => [
                'given_names' => auth()->user()->Nama ?? 'Client Identra',
                'email' => auth()->user()->email ?? 'client@identra.com',
            ]
        ]);

        try {
            // 5. Kirim request ke server Xendit
            $result = $apiInstance->createInvoice($createInvoiceRequest);
            
        // 2. KONDISI REAL: Simpan data transaksi ke database lokal
            \App\Models\Transaction::create([
                'user_id' => auth()->user()->User_ID,
                'external_id' => $createInvoiceRequest['external_id'],
                'amount' => $totalHarga,
                'status' => 'PAID', // Default menunggu dibayar
                'progress' => 30,       // Tahap awal setelah invoice terbit
            ]);

            // Return URL Invoice sukses
            return response()->json(['invoice_url' => $result->getInvoiceUrl()]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}