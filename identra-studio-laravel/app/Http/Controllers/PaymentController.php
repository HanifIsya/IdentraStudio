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
        // 1. PERBAIKAN: Tangkap nilai 'amount' dan 'layanan_id' sesuai kiriman JSON dari cart.js
        $totalHarga = $request->input('amount');
        $layananId  = $request->input('layanan_id');

        if (!$totalHarga || $totalHarga <= 0) {
            return response()->json(['error' => 'Keranjang kosong atau nominal salah'], 400);
        }

        if (!$layananId) {
            return response()->json(['error' => 'Gagal memproses, ID Layanan tidak terbaca.'], 400);
        }

        // 2. Set API Key secara global pada properti statis Configuration Xendit SDK v3
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

        // 3. Buat instance InvoiceApi
        $apiInstance = new InvoiceApi();

        // 4. Susun parameter request invoice
        $createInvoiceRequest = new CreateInvoiceRequest([
            'external_id' => 'IDENTRA-' . time(),
            'amount' => (double) $totalHarga,
            'description' => 'Pembayaran Jasa Layanan - Identra Studio',
            'invoice_duration' => 86400,
            'success_redirect_url' => url('/tracking'),
            'failure_redirect_url' => url('/cart'),
            'customer' => [
                'given_names' => auth()->user()->Nama ?? 'Client Identra',
                'email' => auth()->user()->Email ?? 'client@identra.com', // Sesuaikan 'Email' kapital jika di database kolomnya kapital
            ]
        ]);

        try {
            // 5. Kirim request ke server Xendit
            $result = $apiInstance->createInvoice($createInvoiceRequest);
            
            // 6. PERBAIKAN: Simpan data transaksi ke database menggunakan data murni kiriman Cart
            \App\Models\Transaction::create([
                'user_id'     => auth()->user()->User_ID,
                'layanan_id'  => $layananId, // <--- SEKARANG 100% DINAMIS MENGIKUTI ID LAYANAN YANG DIPILIH
                'external_id' => $createInvoiceRequest['external_id'],
                'amount'      => $totalHarga,
                'status'      => 'PAID',     // Langsung diset lunas demi keperluan simulasi sandbox/demo
                'progress'    => 30,         // Tahap awal setelah invoice sukses
            ]);

            // Return URL Invoice sukses
            return response()->json(['invoice_url' => $result->getInvoiceUrl()]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}