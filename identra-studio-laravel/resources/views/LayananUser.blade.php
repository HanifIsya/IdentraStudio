<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Layanan - Identra Studio</title>
    
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

        /* Sidebar Dipertahankan Sesuai Konsensus */
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

        /* Card Studio Premium Ringan & Teduh */
        .card-service {
            background-color: #FAFAFA;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            padding: 28px 24px;
            display: flex;
            flex-direction: column;
            justify-between;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.02);
        }

        .card-service:hover {
            transform: translateY(-4px);
            border-color: #D4AF37;
            background-color: #FFFFFF;
            box-shadow: 0 16px 24px -8px rgba(212, 175, 55, 0.12);
        }

        .icon-container {
            width: 52px;
            height: 52px;
            background-color: #F1F3F5;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #334155;
            transition: all 0.25s ease;
        }

        .card-service:hover .icon-container {
            background-color: #2B2B30;
            color: #D4AF37;
            border-color: transparent;
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
            position: relative;
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
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-400 hover:text-red-400 transition-colors text-left">
                <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> <span>Logout Sesi</span>
            </button>
        </form>
    </aside>

    <main class="main-workspace">
        
        <header class="flex justify-between items-center mb-10">
            <div class="space-y-0.5">
                <span class="text-[10px] font-mono-atkinson text-id-gold font-bold uppercase tracking-widest"> STUDIO SERVICES</span>
                <h1 class="text-3xl font-black text-[#2B2B30] tracking-tight">Katalog Jasa</h1>
                <p class="text-xs text-slate-500 font-medium">Pilih instrumentasi kreatif yang Anda butuhkan.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('cart') }}" class="util-btn shadow-sm">
                    <i class="fa-solid fa-cart-shopping text-sm text-slate-600"></i>
                    <span id="cart-badge" class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[9px] font-black px-1.5 py-0.5 rounded-full hidden animate-bounce">0</span>
                </a>
                <button class="util-btn shadow-sm">
                    <i class="fa-solid fa-bell text-sm"></i>
                </button>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($layanans as $layanan)
            <div class="card-service group">
                <div class="flex-grow">
                    <div class="flex items-start gap-4 mb-6">
                        <div class="icon-container flex-shrink-0">
                            <i class="fa-solid {{ $layanan->Ikon ?? $layanan->ikon ?? 'fa-cubes' }}"></i>
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-bold text-base text-[#2B2B30] tracking-tight truncate">{{ $layanan->Nama_Layanan ?? $layanan->nama_layanan }}</h3>
                            <p class="text-[11px] text-slate-500 mt-0.5 leading-normal line-clamp-2">{{ $layanan->tagline }}</p>
                        </div>
                    </div>

                    <ul class="space-y-2.5 mb-8 border-t border-slate-100 pt-4">
                        @foreach($layanan->fitur as $fitur)
                        <li class="flex items-start gap-2.5 text-xs text-slate-600">
                            <i class="fa-solid fa-circle-check text-emerald-500 text-[13px] mt-0.5 flex-shrink-0"></i>
                            <span class="leading-relaxed">{{ $fitur }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-slate-100 mt-auto">
                    <button 
                        class="btn-add-cart bg-[#2B2B30] hover:bg-[#1E1E24] text-white text-xs px-4 py-2.5 rounded-xl font-bold transition-all active:scale-95 cursor-pointer"
                        data-id="{{ $layanan->Layanan_ID }}"
                        data-nama="{{ $layanan->Nama_Layanan ?? $layanan->nama_layanan }}"
                        data-harga="{{ $layanan->harga }}">
                        Pilih Jasa
                    </button>
                    
                    <span class="bg-id-gold/10 text-[#AA7C11] border border-id-gold/20 px-3.5 py-1.5 rounded-full text-xs font-black tracking-wide">
                        Rp {{ number_format((float)$layanan->harga, 0, ',', '.') }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <script src="{{ asset('js/layanan.js') }}"></script>
</body>
</html>