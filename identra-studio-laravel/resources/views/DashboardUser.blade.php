<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workspace Dashboard - Identra Studio</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Mono:wght@400;600&family=Urbanist:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Urbanist', sans-serif;
            background-color: #EFEFF2; /* Soft Cool Platinum - Mengurangi pancaran cahaya tajam */
            color: #2B2B30; /* Charcoal Graphite - Lembut di mata dibanding hitam pekat */
        }

        /* Sidebar Kokoh dipertahankan sesuai request */
        .sidebar {
            width: 250px;
            min-width: 250px;
            background-color: #1E1E24;
            color: #FFFFFF;
            height: 100vh;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.02);
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

        /* Card Studio Premium - Transisi Warna Lembut, Spacing Elegan */
        .studio-card {
            background-color: #FAFAFA; /* Off-White hangat mengurangi kontras ekstrem */
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 20px;
            box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.02);
        }

        /* Service Box Grid */
        .service-box {
            background-color: #FAFAFA;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            padding: 24px 16px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .service-box:hover {
            transform: translateY(-2px);
            border-color: #D4AF37;
            background-color: #FFFFFF;
            box-shadow: 0 12px 20px -8px rgba(212, 175, 55, 0.12);
        }

        .icon-container {
            width: 52px;
            height: 52px;
            background-color: #F1F3F5;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            margin: 0 auto 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #334155;
            transition: all 0.25s ease;
        }

        .service-box:hover .icon-container {
            background-color: #2B2B30;
            color: #D4AF37;
            border-color: transparent;
        }

        /* Notif Bell Badge */
        .bell-btn {
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

        .bell-btn:hover {
            background-color: #FFFFFF;
            color: #2B2B30;
            border-color: #CBD5E1;
        }

        .workspace-main::-webkit-scrollbar { width: 5px; }
        .workspace-main::-webkit-scrollbar-track { background: transparent; }
        .workspace-main::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
    </style>
</head>
<body class="min-h-screen flex overflow-hidden">

    <aside class="sidebar p-6 flex flex-col justify-between flex-shrink-0">
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
                <a href="{{ route('dashboard') }}" class="nav-link active">
                    <i class="fa-solid fa-table-columns w-5 text-center"></i> <span>Dashboard</span>
                </a>
                <a href="{{ route('layanan.index') }}" class="nav-link">
                    <i class="fa-solid fa-layer-group"></i>
                    <span class="tracking-wide">Layanan</span>
                </a>
                <a href="{{ route('transaction.index') }}" class="nav-link {{ Route::is('transaction.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i><span>Transaction</span>
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

    <main class="flex-grow p-8 lg:p-12 overflow-y-auto h-screen workspace-main">

        <header class="flex justify-between items-center mb-10">
            <div class="space-y-0.5">
                <span class="text-[10px] font-mono-atkinson text-id-gold font-bold uppercase tracking-widest"> CLIENT CORE HUB</span>
                <h1 class="text-2xl font-black text-[#2B2B30] tracking-tight">Selamat Datang, {{ explode(' ', auth()->user()->Nama)[0] }}</h1>
                <p class="text-xs text-slate-500 font-medium">Hari ini &bull; {{ date('l, d F Y') }}</p>
            </div>
            <button class="bell-btn active:scale-95 shadow-sm">
                <i class="fa-solid fa-bell"></i>
            </button>
        </header>

        <section class="mb-12">
            <h3 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-4"> Pilihan Layanan</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                
                @forelse($layanans as $layanan)
                    <div onclick="window.location='{{ route('layanan.index') }}'" class="service-box cursor-pointer group">
                        <div class="icon-container">
                            <i class="fa-solid {{ $layanan->Ikon ?? $layanan->ikon ?? 'fa-cubes' }}"></i>
                        </div>
                        <h4 class="text-xs font-bold text-[#2B2B30] group-hover:text-id-gold transition-colors truncate w-full mb-1">
                           {{ $layanan->Nama_Layanan ?? $layanan->nama_layanan }}
                        </h4>
                        <p class="text-[10px] text-slate-500 line-clamp-2 w-full px-1 leading-normal">
                           {{ $layanan->tagline }}
                        </p>
                    </div>
                @empty
                    <div class="col-span-6 text-center py-12 studio-card p-6">
                        <p class="text-xs text-slate-400 italic">Belum ada pilihan paket layanan aktif.</p>
                    </div>
                @endforelse

            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            
            <div class="lg:col-span-3 studio-card p-6 md:p-8 flex flex-col justify-between space-y-6">
                <div class="space-y-3">
                    <span class="bg-blue-50 text-blue-600 border border-blue-100 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md inline-block">
                        Workspace Guidelines
                    </span>
                    <h3 class="text-lg font-black text-[#2B2B30] tracking-tight">Bagaimana cara memulai pengerjaan proyek?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Silakan tentukan paket yang Anda inginkan di halaman <strong class="text-[#2B2B30] font-semibold">Layanan</strong> dan lakukan pemesanan. Setelah verifikasi transaksi lunas selesai, sistem akan otomatis membuatkan sebuah <strong class="text-id-gold font-semibold">Project Room</strong> mandiri pada menu <strong class="text-[#2B2B30] font-semibold">Tracking</strong> untuk mengawal koordinasi berkas serta pengerjaan aset kreatif oleh tim developer secara aman.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 flex flex-wrap gap-3">
                    <a href="{{ route('layanan.index') }}" class="bg-gradient-to-r from-id-gold to-[#AA7C11] text-black font-bold text-xs px-5 py-3 rounded-xl active:scale-95 flex items-center gap-1.5 shadow-sm">
                        Pesan Jasa Baru <i class="fa-solid fa-chevron-right text-[9px]"></i>
                    </a>
                    <a href="{{ route('project.tracking') }}" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-bold text-xs px-5 py-3 rounded-xl transition-all active:scale-95 shadow-sm">
                        Periksa Progress Room
                    </a>
                </div>
            </div>

            <div class="lg:col-span-2 studio-card p-6 md:p-8 flex flex-col justify-between space-y-6">
                <div class="space-y-3">
                    <h4 class="text-xs font-bold text-[#2B2B30] uppercase tracking-widest border-b border-slate-100 pb-2 flex items-center gap-2">
                        <i class="fa-solid fa-headset text-id-gold"></i> Identra Hub Info
                    </h4>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Butuh penyesuaian sistem khusus di luar opsi paket standar, atau ingin mendiskusikan klausul kontrak agensi? Hubungi kami langsung:
                    </p>
                    <div class="space-y-3 text-xs font-medium">
                        <div class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-envelope text-slate-400 w-4 text-center"></i> <span class="font-mono-atkinson text-slate-600">support@identra.com</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-700">
                            <i class="fa-solid fa-location-dot text-slate-400 w-4 text-center"></i> <span class="line-clamp-2 text-slate-600">Gedung Workspace Identra Studio, Surabaya</span>
                        </div>
                    </div>
                </div>
                <div class="text-[9px] text-slate-400 font-mono text-right uppercase tracking-wider">
                    Secured by Identra Core System &copy; {{ date('Y') }}
                </div>
            </div>

        </div>

    </main>

</body>
</html>