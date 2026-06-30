<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoiceNo }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #2d3748; font-size: 13px; line-height: 1.5; margin: 0; padding: 0; }
        .invoice-box { max-width: 800px; margin: auto; padding: 10px; }
        
        /* Mengubah border utama menjadi Abu-abu Profesional */
        .header { margin-bottom: 30px; border-bottom: 2px solid #718096; padding-bottom: 15px; }
        
        /* Skema Warna Abu-abu Gelap Minimalis */
        .brand { font-size: 24px; font-weight: bold; color: #2d3748; letter-spacing: 1px; }
        .brand-sub { font-size: 11px; color: #718096; font-weight: normal; display: block; }
        .invoice-title { font-size: 20px; text-align: right; font-weight: bold; color: #4a5568; text-transform: uppercase; }
        
        .meta-table { width: 100%; margin-bottom: 30px; }
        .meta-table td { vertical-align: top; width: 50%; }
        
        /* Judul Section menjadi Abu-abu */
        .section-title { font-size: 11px; font-weight: bold; color: #4a5568; text-transform: uppercase; margin-bottom: 5px; }
        
        /* Tabel Detail dengan Nuansa Abu-abu Netral */
        .details-table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        .details-table th { background-color: #edf2f7; color: #2d3748; font-weight: bold; padding: 10px; border: 1px solid #cbd5e0; font-size: 12px; }
        .details-table td { padding: 12px 10px; border: 1px solid #edf2f7; }
        
        /* Baris Total Akhir Netral */
        .total-row td { font-weight: bold; font-size: 14px; background-color: #f7fafc; border-top: 2px solid #4a5568; color: #2d3748; }
    </style>
</head>
<body>

    <div class="invoice-box">
        <table class="header" width="100%">
            <tr>
                <td>
                    <span class="brand">IDENTRA STUDIO</span>
                    <span class="brand-sub">Professional Web & Mobile Agency</span>
                </td>
                <td class="invoice-title">Official Invoice</td>
            </tr>
        </table>

        <table class="meta-table">
            <tr>
                <td>
                    <div class="section-title">Diterbitkan Untuk:</div>
                    <strong>{{ $transaction->user->Nama ?? 'Client Resmi' }}</strong><br>
                    Email: {{ $transaction->user->Email ?? '-' }}<br>
                    Status: <span style="color: #4a5568; font-weight: bold;">LUNAS (PAID)</span>
                </td>
                <td style="text-align: right;">
                    <div class="section-title">Detail Dokumen:</div>
                    Nomor Invoice: <strong>{{ $invoiceNo }}</strong><br>
                    Tanggal Pembayaran: {{ \Carbon\Carbon::parse($transaction->updated_at)->translatedFormat('d F Y H:i') }} WIB<br>
                    Metode Pembayaran: Otomatis Gateway<br>
                </td>
            </tr>
        </table>

        <table class="details-table">
            <thead>
                <tr>
                    <th style="text-align: left; width: 60%;">Deskripsi Layanan</th>
                    <th style="text-align: center; width: 15%;">Kuantitas</th>
                    <th style="text-align: right; width: 25%;">Harga Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $transaction->layanan->Nama_Layanan ?? $transaction->layanan->nama_layanan ?? 'Website Studio (Standard)' }}</strong>
                    </td>
                    <td style="text-align: center;">1x</td>
                    <td style="text-align: right; font-weight: bold;">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="2" style="text-align: right;">Total Pembayaran (NET):</td>
                    <td style="text-align: right;">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>