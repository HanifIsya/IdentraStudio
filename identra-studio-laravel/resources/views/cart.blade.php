<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Belanja - Identra Studio</title>
    
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

        /* Sidebar Dipertahankan Konsisten Sesuai Otoritas UI */
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
            text-decoration: none;
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

        /* Container Card Style Studio Light */
        .studio-card {
            background-color: #FAFAFA;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.02);
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
                <a href="{{ route('layanan.index') }}" class="nav-link active">
                    <i class="fa-solid fa-layer-group w-5 text-center"></i> <span>Layanan</span>
                </a>
                <a href="{{ route('transaction.index') }}" class="nav-link {{ Route::is('transaction.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-invoice-dollar w-5 text-center"></i> <span>Transaction</span>
                </a>
                <a href="{{ route('project.tracking') }}" class="nav-link">
                    <i class="fa-solid fa-location-dot w-5 text-center"></i> <span>Tracking</span>
                </a>
            </nav>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="pt-4 border-t border-white/5">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-400 hover:text-red-400 transition-colors text-left cursor-pointer">
                <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> <span>Logout Sesi</span>
            </button>
        </form>
    </aside>

    <main class="main-workspace">
        
        <header class="mb-10">
            <a href="{{ route('layanan.index') }}" class="text-xs font-bold text-slate-500 hover:text-id-gold transition-colors flex items-center gap-1.5 no-underline">
                <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Katalog Jasa
            </a>
            <div class="space-y-0.5 mt-4">
                <span class="text-[10px] font-mono-atkinson text-[#AA7C11] font-bold uppercase tracking-widest"> CHECKOUT REVIEW</span>
                <h1 class="text-3xl font-black text-[#2B2B30] tracking-tight">Review Project Cart</h1>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <div class="lg:col-span-2">
                <div class="studio-card p-6 md:p-8">
                    <h2 class="text-sm font-black uppercase text-slate-400 tracking-wider mb-5 border-b border-slate-100 pb-3"> Jasa yang Anda Pilih</h2>
                    
                    <div id="cart-items-container" class="space-y-4"></div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="studio-card p-6 md:p-8">
                    <h2 class="text-sm font-black uppercase text-slate-400 tracking-wider mb-5 border-b border-slate-100 pb-3"> Ringkasan Biaya</h2>
                    
                    <div class="space-y-4 text-xs font-semibold text-slate-600">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500">Estimasi Timeline</span>
                            <span class="text-[#2B2B30]">Diskusi Project Room</span>
                        </div>
                        
                        <div class="pt-3 border-t border-slate-100">
                            <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider block">Total IDR (Rupiah)</span>
                            <div id="total-idr" class="text-3xl font-black text-[#AA7C11] mt-1">Rp 0</div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 bg-slate-50 border border-slate-200 p-4 rounded-xl space-y-3">
                            <span class="text-[9px] font-bold text-slate-500 uppercase tracking-wider block">
                                <i class="fa-solid fa-globe text-id-gold mr-1"></i> International Rates Equivalent
                            </span>
                            <div class="flex justify-between items-center font-medium">
                                <span class="text-[11px] text-slate-500">Estimasi USD ($)</span>
                                <span id="total-usd" class="font-bold text-[#2B2B30] font-mono-atkinson text-xs">Calculating...</span>
                            </div>
                            <div class="flex justify-between items-center font-medium">
                                <span class="text-[11px] text-slate-500">Estimasi SGD ($)</span>
                                <span id="total-sgd" class="font-bold text-[#2B2B30] font-mono-atkinson text-xs">Calculating...</span>
                            </div>
                        </div>
                    </div>

                    <button id="pay-button" class="w-full mt-6 bg-[#2B2B30] hover:bg-[#1E1E24] text-white text-xs uppercase tracking-widest font-black py-4 px-4 rounded-xl transition-all shadow active:scale-[0.98] cursor-pointer">
                        Bayar Sekarang (Sandbox)
                    </button>
                </div>
            </div>
            
        </div>
    </main>

    <script src="{{ asset('js/cart.js') }}"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</body>
</html>