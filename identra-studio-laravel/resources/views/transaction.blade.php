<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Riwayat Transaksi - Identra Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#0b0a14] text-white font-sans min-h-screen">

    <div class="max-w-6xl mx-auto px-4 py-8">
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Riwayat Transaksi</h1>
                <p class="text-xs text-gray-400">Daftar pembayaran lunas dan unduh berkas invoice resmi Anda</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-xs bg-white/5 hover:bg-white/10 px-4 py-2 rounded-xl border border-white/10 transition-all flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        @if($transactions->isEmpty())
            <div class="bg-white/5 border border-white/10 rounded-2xl p-12 text-center max-w-md mx-auto my-12 shadow-xl">
                <div class="w-16 h-16 bg-purple-600/20 text-purple-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="fa-solid fa-file-invoice"></i>
                </div>
                <h3 class="text-lg font-bold mb-1">Belum Ada Transaksi</h3>
                <p class="text-xs text-gray-400 mb-6 px-4">Anda belum memiliki riwayat transaksi atau pembayaran lunas bersama Identra Studio.</p>
                <a href="{{ route('layanan.index') }}" class="inline-block bg-purple-600 hover:bg-purple-700 text-white text-xs px-6 py-3 rounded-xl font-bold transition-all shadow-md">
                    Lihat Katalog Jasa
                </a>
            </div>
        @else
            <div class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden shadow-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-white/[0.03] border-b border-white/10 text-gray-400 font-bold uppercase tracking-wider">
                                <th class="p-4">No. Invoice</th>
                                <th class="p-4">Layanan / Paket</th>
                                <th class="p-4">Tanggal Bayar</th>
                                <th class="p-4">Total</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($transactions as $trx)
                                <tr class="hover:bg-white/[0.01] transition-all">
                                    <td class="p-4 font-mono font-bold text-purple-400">
                                        #INV-{{ date('Ymd', strtotime($trx->updated_at)) }}-{{ str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-white">
                                            {{ $trx->layanan->Nama_Layanan ?? $trx->layanan->nama_layanan ?? 'Custom Project' }}
                                        </div>
                                        <div class="text-[10px] text-gray-400 mt-0.5">ID Proyek: #00{{ $trx->id }}</div>
                                    </td>
                                    <td class="p-4 text-gray-300">
                                        {{ \Carbon\Carbon::parse($trx->updated_at)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="p-4 font-bold text-emerald-400">
                                        Rp {{ number_format($trx->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4">
                                        <span class="text-[10px] bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 px-2.5 py-1 rounded-lg font-bold uppercase tracking-wide">
                                            {{ $trx->status }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="{{ route('transaction.download-invoice', $trx->id) }}" 
                                           class="inline-flex items-center gap-1.5 bg-purple-600 hover:bg-purple-700 text-white font-bold px-3 py-2 rounded-xl transition-all shadow active:scale-95 text-[11px]">
                                            <i class="fa-solid fa-file-pdf"></i> Download PDF
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>

</body>
</html>