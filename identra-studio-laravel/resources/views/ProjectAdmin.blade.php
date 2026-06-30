<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Client Management - Admin Headquarters</title>
    
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

        /* Input Progress Internal Control */
        .studio-input-progress {
            background-color: #FFFFFF !important;
            border: 1px solid #DDE1E6 !important;
            color: #2B2B30 !important;
            transition: all 0.2s ease;
        }
        .studio-input-progress:focus {
            border-color: #D4AF37 !important;
            outline: none !important;
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
            <a href="{{ route('admin.layanan.index') }}" class="nav-link">
                <i class="fa-solid fa-boxes-packing w-5 text-center"></i> <span>Layanan</span>
            </a>
            <a href="{{ route('admin.transaction.index') }}" class="nav-link">
                <i class="fa-solid fa-file-invoice-dollar w-5 text-center"></i> <span>Transaksi</span>
            </a>
            <a href="{{ route('admin.project.index') }}" class="nav-link active">
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
                <span class="text-[10px] font-mono-atkinson text-id-gold font-bold uppercase tracking-widest"> PRODUCTION OPERATION TRACKER</span>
                <h1 class="text-3xl font-black text-[#2B2B30] tracking-tight">Project Client Management</h1>
                <p class="text-xs text-slate-500 font-medium">Kelola, koordinasikan, dan perbarui persentase progress pengerjaan proyek digital customer.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="util-btn shadow-sm">
                    <i class="fa-solid fa-bell text-sm"></i>
                </button>
            </div>
        </header>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 px-4 py-3.5 rounded-xl text-xs flex items-center gap-2.5 mb-6">
                <i class="fa-solid fa-circle-check text-sm flex-shrink-0"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        @if($projects->isEmpty())
            <div class="studio-card p-12 text-center max-w-md mx-auto my-12">
                <div class="w-14 h-14 bg-amber-500/10 text-[#AA7C11] border border-id-gold/20 rounded-xl flex items-center justify-center mx-auto mb-4 text-xl">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <h3 class="text-base font-bold text-[#2B2B30] mb-1">Belum Ada Proyek Aktif</h3>
                <p class="text-xs text-slate-500 mb-6 px-4 font-medium leading-relaxed">Belum ada pembelian unit paket jasa baru dari klien yang tervalidasi otomatis oleh sistem saat ini.</p>
            </div>
        @else
            <div class="studio-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-black/[0.01] border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                                <th class="p-4 w-28 font-bold">ID Proyek</th>
                                <th class="p-4 font-bold">Customer</th>
                                <th class="p-4 font-bold">Layanan Dipesan</th>
                                <th class="p-4 w-1/4 font-bold">Status Progress</th>
                                <th class="p-4 text-center w-52 font-bold">Aksi Perubahan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-[#2B2B30] font-medium">
                            @foreach($projects as $project)
                                <tr class="hover:bg-white transition-colors">
                                    <td class="p-4 font-mono-atkinson font-bold text-[#AA7C11]">
                                        #PRJ-{{ str_pad($project->id, 4, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-slate-800">{{ $project->user->Nama ?? 'Client Resmi' }}</div>
                                        <div class="text-[10px] text-slate-400 font-semibold mt-0.5">{{ $project->user->Email ?? '-' }}</div>
                                    </td>
                                    <td class="p-4 text-slate-600 font-semibold">
                                        {{ $project->layanan->Nama_Layanan ?? $project->layanan->nama_layanan ?? 'Custom Project' }}
                                    </td>
                                    <td class="p-4">
                                        <div class="flex justify-between items-center mb-1.5 font-semibold text-[11px]">
                                            @if($project->progress == 100)
                                                <span class="text-emerald-600 flex items-center gap-1">
                                                    <i class="fa-solid fa-circle-check"></i> Selesai (Completed)
                                                </span>
                                            @else
                                                <span class="text-[#AA7C11] flex items-center gap-1">
                                                    <i class="fa-solid fa-spinner animate-spin text-[10px]"></i> Sedang Diproses
                                                </span>
                                            @endif
                                            <span class="font-mono-atkinson text-slate-700 font-black">{{ $project->progress }}%</span>
                                        </div>
                                        <div class="w-full bg-slate-200 h-2 rounded-full overflow-hidden p-[1px]">
                                            <div class="h-full rounded-full transition-all duration-500 {{ $project->progress == 100 ? 'bg-gradient-to-r from-emerald-500 to-teal-600' : 'bg-gradient-to-r from-[#D4AF37] to-[#AA7C11]' }}" 
                                                 style="width: {{ $project->progress }}%"></div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-center">
                                        <form action="{{ route('admin.project.update-progress', $project->id) }}" method="POST" class="flex items-center gap-2 justify-center">
                                            @csrf
                                            <div class="relative flex items-center">
                                                <input type="number" name="progress" min="0" max="100" value="{{ $project->progress }}"
                                                       class="studio-input-progress w-20 rounded-xl px-2.5 py-1.5 text-center text-slate-800 text-xs font-mono-atkinson font-bold pr-5 shadow-sm">
                                                <span class="absolute right-2 text-slate-400 text-[10px] font-bold pointer-events-none">%</span>
                                            </div>
                                            <button type="submit" class="bg-[#2B2B30] hover:bg-[#1E1E24] text-white text-[11px] font-black uppercase tracking-wider px-3.5 py-2 rounded-xl transition-all flex items-center gap-1 shadow-sm active:scale-95 cursor-pointer">
                                                <i class="fa-solid fa-floppy-disk text-id-gold"></i> Simpan
                                            </button>
                                        </form>
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