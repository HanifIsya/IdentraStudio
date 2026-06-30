<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Riwayat Transaksi - Identra Studio</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Mono:wght@400;600&family=Urbanist:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Urbanist', sans-serif;
            background-color: #EFEFF2; /* Soft Cool Platinum */
            color: #2B2B30; /* Charcoal Graphite */
        }

        /* Sidebar Dipertahankan Konsisten */
        .sidebar {
            width: 250px;
            min-width: 250px;
            background-color: #1E1E24;
            color: #FFFFFF;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.02);
            z-index: 30;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            color: #9CA3AF;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.25s ease;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.04);
            color: #FFFFFF;
        }

        .nav-link.active {
            background-color: rgba(212, 175, 55, 0.1);
            color: #D4AF37;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .main-workspace {
            margin-left: 250px;
            padding: 32px 48px;
            min-height: 100vh;
        }

        /* Container & Table Studio Card Style */
        .studio-card {
            background-color: #FAFAFA;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.02);
        }

        /* Action Top Utilities Buttons */
        .util-btn {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background-color: #FAFAFA;
            border: 1px solid #E2E8F0;
            color: #4A5568;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .util-btn:hover {
            background-color: #FFFFFF;
            color: #2B2B30;
            border-color: #CBD5E1;
        }
    </style>
</head>
<body class="min-h-screen">

    <aside class="sidebar p-6 flex flex-col justify-between">
        <div class="space-y-8">
            <div class="px-2 pt-2">
                <h1 class="text-lg font-black tracking-wider text-white">IDENTRA<span class="text-id-gold">.</span></h1>
            </div>

            <div class="flex items-center gap-3 bg-white/[0.03] p-3 rounded-xl border border-white/5">
                <div class="w-9 h-9 rounded-xl bg-id-gold text-black font-bold flex items-center justify-center text-xs">
                    {{ strtoupper(substr(auth()->user()->Nama, 0, 2)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="text-xs font-bold truncate text-white leading-tight">{{ auth()->user()->Nama }}</h4>
                    <p class="text-[10px] text-gray-400 truncate mt-0.5">{{ auth()->user()->Email }}</p>
                </div>
            </div>

            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fa-solid fa-table-columns w-5 text-center"></i> <span>Dashboard</span>
                </a>
                <a href="{{ route('layanan.index') }}" class="nav-link">
                    <i class="fa-solid fa-layer-group w-5 text-center"></i> <span>Layanan</span>
                </a>
                <a href="{{ route('transaction.index') }}" class="nav-link active">
                    <i class="fa-solid fa-file-invoice-dollar w-5 text-center"></i> <span>Transaction</span>
                </a>
                <a href="{{ route('project.tracking') }}" class="nav-link">
                    <i class="fa-solid fa-location-dot w-5 text-center"></i> <span>Tracking</span>
                </a>
            </nav>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="pt-4 border-t border-white/5">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-400 hover:text-red-400 transition-colors text-left">
                <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> <span>Logout Sesi</span>
            </button>
        </form>
    </aside>

    <main class="main-workspace">
        
        <header class="flex justify-between items-center mb-10">
            <div class="space-y-0.5">
                <span class="text-[10px] font-mono-atkinson text-id-gold font-bold uppercase tracking-widest"> LEDGER REPORT</span>
                <h1 class="text-3xl font-black text-[#2B2B30] tracking-tight">Riwayat Transaksi</h1>
                <p class="text-xs text-slate-500 font-medium">Daftar pembayaran lunas dan unduh berkas invoice resmi Anda.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="util-btn shadow-sm">
                    <i class="fa-solid fa-bell text-sm"></i>
                </button>
            </div>
        </header>

        @if($transactions->isEmpty())
            <div class="studio-card p-12 text-center max-w-md mx-auto my-12">
                <div class="w-14 h-14 bg-amber-500/10 text-[#AA7C11] border border-id-gold/20 rounded-xl flex items-center justify-center mx-auto mb-4 text-xl">
                    <i class="fa-solid fa-file-invoice"></i>
                </div>
                <h3 class="text-base font-bold text-[#2B2B30] mb-1">Belum Ada Transaksi</h3>
                <p class="text-xs text-slate-500 mb-6 px-4 font-normal leading-relaxed">Anda belum memiliki riwayat pembelian paket atau modul pengerjaan aktif bersama Identra Studio.</p>
                <a href="{{ route('layanan.index') }}" class="inline-block bg-[#2B2B30] hover:bg-[#1E1E24] text-white text-xs px-6 py-3 rounded-xl font-bold transition-all shadow-sm active:scale-95">
                    Lihat Katalog Jasa
                </a>
            </div>
        @else
            <div class="studio-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-black/[0.02] border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                                <th class="p-4 font-bold">No. Invoice</th>
                                <th class="p-4 font-bold">Layanan / Paket</th>
                                <th class="p-4 font-bold">Tanggal Bayar</th>
                                <th class="p-4 font-bold">Total Pembayaran</th>
                                <th class="p-4 font-bold">Status</th>
                                <th class="p-4 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-[#2B2B30] font-medium">
                            @foreach($transactions as $trx)
                                <tr class="hover:bg-white transition-colors">
                                    <td class="p-4 font-mono font-bold text-[#AA7C11]">
                                        #INV-{{ date('Ymd', strtotime($trx->updated_at)) }}-{{ str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-[#2B2B30]">
                                            {{ $trx->layanan->Nama_Layanan ?? $trx->layanan->nama_layanan ?? 'Custom Project' }}
                                        </div>
                                        <div class="text-[10px] text-slate-400 font-mono-atkinson mt-0.5">ID ROOM: #00{{ $trx->id }}</div>
                                    </td>
                                    <td class="p-4 text-slate-500">
                                        {{ \Carbon\Carbon::parse($trx->updated_at)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="p-4 font-bold text-slate-800">
                                        Rp {{ number_format($trx->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4">
                                        @if(in_array($trx->status, ['PAID', 'SETTLED']))
                                            <span class="text-[10px] bg-emerald-50 text-emerald-600 border border-emerald-200 px-2.5 py-1 rounded-md font-bold uppercase tracking-wide">
                                                Lunas
                                            </span>
                                        @else
                                            <span class="text-[10px] bg-amber-50 text-amber-600 border border-amber-200 px-2.5 py-1 rounded-md font-bold uppercase tracking-wide">
                                                {{ $trx->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="{{ route('transaction.download-invoice', $trx->id) }}" 
                                           class="inline-flex items-center gap-1.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-bold px-3 py-2 rounded-xl transition-all shadow-sm active:scale-95 text-[11px]">
                                            <i class="fa-solid fa-file-pdf text-red-500"></i> Unduh PDF
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </main>

</body>
</html>