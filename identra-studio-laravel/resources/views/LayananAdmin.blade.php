<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Layanan - Admin Headquarters</title>
    
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

        /* Sidebar Matte Charcoal Mewah & Ramping */
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
            display: flex;
            flex-direction: column;
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

        /* Container Card Style Studio */
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

    <aside class="sidebar p-6 py-8">
        <div class="px-2 pt-2 mb-8">
            <h1 class="text-lg font-black tracking-wider text-white">IDENTRA<span class="text-id-gold">.</span><span class="text-[10px] ml-1.5 px-1.5 py-0.5 bg-id-gold/10 text-id-gold rounded font-bold uppercase tracking-widest border border-id-gold/20">HQ</span></h1>
        </div>

        <div class="flex items-center gap-3 bg-white/[0.03] p-3 rounded-xl border border-white/5 mb-6">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-id-gold/20 to-white/5 flex items-center justify-center font-bold text-sm text-id-gold border border-id-gold/20">
                {{ strtoupper(substr(auth()->user()->Nama, 0, 2)) }}
            </div>
            <div class="min-w-0 flex-1">
                <h4 class="text-xs font-bold truncate text-white leading-tight">{{ auth()->user()->Nama }}</h4>
                <p class="text-[10px] text-gray-400 truncate mt-0.5">{{ auth()->user()->Email }}</p>
            </div>
        </div>

        <nav class="space-y-1 flex-grow">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fa-solid fa-chart-line w-5 text-center"></i> <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.user.index') }}" class="nav-link">
                <i class="fa-solid fa-users-gear w-5 text-center"></i> <span>User Management</span>
            </a>
            <a href="{{ route('admin.layanan.index') }}" class="nav-link active">
                <i class="fa-solid fa-boxes-packing w-5 text-center"></i> <span>Layanan</span>
            </a>
            <a href="{{ route('admin.transaction.index') }}" class="nav-link {{ Route::is('admin.transaction.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-invoice-dollar w-5 text-center"></i> <span>Transaksi</span>
            </a>
            <a href="{{ route('admin.project.index') }}" class="nav-link {{ Route::is('admin.project.*') ? 'active' : '' }}">
                <i class="fa-solid fa-briefcase w-5 text-center"></i> <span>Project Client</span>
            </a>
            <a href="{{ route('admin.asset.index') }}" class="nav-link {{ Route::is('admin.asset.index') ? 'active' : '' }}">
                <i class="fa-solid fa-folder-open w-5 text-center"></i> <span>File & Asset</span>
            </a>
            <a href="{{ route('chat.index') }}" class="nav-link {{ Route::is('chat.index') ? 'active' : '' }}">
                <i class="fa-solid fa-comments w-5 text-center"></i> <span>Chat Support</span>
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" class="pt-4 border-t border-white/5 mt-auto">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-400 hover:text-red-400 transition-colors text-left cursor-pointer">
                <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> <span>Logout Sesi</span>
            </button>
        </form>
    </aside>

    <main class="main-workspace">
        
        <header class="flex justify-between items-center mb-10">
            <div class="space-y-0.5">
                <span class="text-[10px] font-mono-atkinson text-id-gold font-bold uppercase tracking-widest"> SERVICE CATALOG INVENTORY</span>
                <h1 class="text-3xl font-black text-[#2B2B30] tracking-tight">Manajemen Layanan</h1>
                <p class="text-xs text-slate-500 font-medium">Kelola, sunting, dan daftarkan instrumen jasa agensi produksi Identra Studio.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="util-btn shadow-sm">
                    <i class="fa-solid fa-bell text-sm"></i>
                </button>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8 items-center">
            <div class="studio-card p-4 flex items-center gap-4">
                <div class="w-11 h-11 bg-slate-100 text-slate-700 rounded-xl border border-slate-200 flex items-center justify-center text-base"><i class="fa-solid fa-boxes-stacked"></i></div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Layanan</p>
                    <p class="font-bold text-base text-[#2B2B30] font-mono-atkinson mt-0.5">{{ $total }}</p>
                </div>
            </div>
            <div class="studio-card p-4 flex items-center gap-4">
                <div class="w-11 h-11 bg-emerald-50 text-emerald-600 rounded-xl border border-emerald-100 flex items-center justify-center text-base"><i class="fa-solid fa-check-double"></i></div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Status Aktif</p>
                    <p class="font-bold text-base text-slate-800 font-mono-atkinson mt-0.5">{{ $total }}</p>
                </div>
            </div>
            <div class="studio-card p-4 flex items-center gap-4">
                <div class="w-11 h-11 bg-amber-50 text-amber-600 rounded-xl border border-amber-100 flex items-center justify-center text-base"><i class="fa-solid fa-pause"></i></div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Nonaktif</p>
                    <p class="font-bold text-base text-slate-800 font-mono-atkinson mt-0.5">0</p>
                </div>
            </div>
            <a href="{{ route('admin.layanan.create') }}" class="bg-gradient-to-r from-id-gold to-[#AA7C11] text-black font-black text-xs uppercase tracking-widest py-4 px-5 rounded-xl transition-all shadow shadow-yellow-600/5 hover:opacity-95 text-center active:scale-[0.98]">
                + Tambah Layanan
            </a>
        </div>

        <div class="studio-card overflow-hidden">
            <div class="p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-100 bg-black/[0.005]">
                <h3 class="font-bold text-base text-[#2B2B30] tracking-tight">Daftar Layanan Agensi</h3>
                <div class="flex gap-2 w-full sm:w-auto">
                    <select class="bg-white border border-slate-200 rounded-xl text-xs px-3 py-2 font-medium text-slate-600 focus:outline-none focus:border-id-gold/30">
                        <option>Semua Kategori</option>
                    </select>
                    <input type="text" placeholder="Cari nama layanan..." class="bg-white border border-slate-200 rounded-xl text-xs px-4 py-2 w-full sm:w-64 font-medium text-[#2B2B30] focus:outline-none focus:border-id-gold/30 placeholder:text-slate-400 shadow-sm">
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-black/[0.01] border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                            <th class="px-6 py-4 font-bold">Layanan</th>
                            <th class="px-6 py-4 font-bold">Kategori</th>
                            <th class="px-6 py-4 font-bold">Deskripsi Singkat (Tagline)</th>
                            <th class="px-6 py-4 font-bold">Harga Base</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-[#2B2B30] font-medium">
                        @foreach($layanans as $layanan)
                        <tr class="hover:bg-white transition-colors">
                            <td class="px-6 py-4 flex items-center gap-3">
                                <div class="w-9 h-9 bg-[#2B2B30] text-id-gold rounded-xl flex items-center justify-center text-sm border border-white/5 flex-shrink-0">
                                    <i class="fa-solid {{ $layanan->ikon ?? $layanan->Ikon ?? 'fa-cubes' }}"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-800 text-sm truncate max-w-[160px]">${{ $layanan->Nama_layanan ?? $layanan->nama_layanan }}</p>
                                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider mt-0.5">Identra Pack</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-500 font-semibold">Studio Pack</td>
                            <td class="px-6 py-4 max-w-xs truncate text-slate-600 font-normal">{{ $layanan->tagline }}</td>
                            <td class="px-6 py-4 font-bold text-slate-800 font-mono-atkinson text-xs">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="text-[10px] bg-emerald-50 text-emerald-600 border border-emerald-200 px-2.5 py-0.5 rounded-md font-bold uppercase tracking-wide">
                                    Aktif
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.layanan.edit', $layanan->Layanan_ID) }}" class="util-btn hover:border-id-gold/30 bg-white shadow-sm" title="Edit Layanan">
                                        <i class="fa-solid fa-pen-to-square text-xs text-slate-600"></i>
                                    </a>
                                    <form action="{{ route('admin.layanan.destroy', $layanan->Layanan_ID) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="util-btn bg-white hover:bg-red-50 border border-slate-200 hover:border-red-200 shadow-sm cursor-pointer" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini dari inventaris?')" title="Hapus Layanan">
                                            <i class="fa-solid fa-trash text-xs text-red-500"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>