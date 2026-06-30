<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Identra Studio</title>
    
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

        /* Status Badge Management */
        .status-badge {
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            display: inline-block;
        }
        .status-pending { background-color: #FEF3C7; color: #D97706; border: 1px solid #FCD34D; }
        .status-progress { background-color: #DBEAFE; color: #2563EB; border: 1px solid #93C5FD; }
        .status-success { background-color: #D1FAE5; color: #059669; border: 1px solid #6EE7B7; }

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

        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
    </style>
</head>
<body class="min-h-screen">

    <aside class="sidebar p-6 p-y-8">
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
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                <i class="fa-solid fa-chart-line w-5 text-center"></i> <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.user.index') }}" class="nav-link {{ Route::is('admin.user.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users-gear w-5 text-center"></i> <span>User Management</span>
            </a>
            <a href="{{ route('admin.layanan.index') }}" class="nav-link {{ Route::is('admin.layanan.*') ? 'active' : '' }}">
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
                <i class="fa-solid fa-power-off w-5 text-center text-red-500/70"></i> <span>Keluar HQ Sesi</span>
            </button>
        </form>
    </aside>

    <main class="main-workspace">
        
        <header class="flex justify-between items-center mb-10">
            <div class="space-y-0.5">
                <span class="text-[10px] font-mono-atkinson text-[#AA7C11] font-bold uppercase tracking-widest"> STUDIO HEADQUARTERS</span>
                <h1 class="text-3xl font-black text-[#2B2B30] tracking-tight">Hello, {{ explode(' ', auth()->user()->Nama)[0] }}</h1>
                <p class="text-xs text-slate-500 font-medium">Hari ini &bull; {{ date('l, d F Y') }}</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="util-btn shadow-sm">
                    <i class="fa-solid fa-bell text-sm"></i>
                </button>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="studio-card p-6 flex justify-between items-center">
                <div class="space-y-1">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Total User</p>
                    <h2 class="text-3xl font-black text-[#2B2B30] font-mono-atkinson">{{ number_format($stats['total_user'], 0, ',', '.') }}</h2>
                </div>
                <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-lg text-slate-500 border border-slate-200">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

            <div class="studio-card p-6 flex justify-between items-center">
                <div class="space-y-1">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Total Order</p>
                    <h2 class="text-3xl font-black text-[#2B2B30] font-mono-atkinson">{{ number_format($stats['total_order'], 0, ',', '.') }}</h2>
                </div>
                <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-lg text-slate-500 border border-slate-200">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>

            <div class="studio-card p-6 flex justify-between items-center border-l-2 border-id-gold">
                <div class="space-y-1">
                    <p class="text-[11px] font-bold text-[#AA7C11] uppercase tracking-widest">Total Revenue</p>
                    <h2 class="text-2xl font-black text-[#2B2B30]">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h2>
                </div>
                <div class="w-12 h-12 rounded-xl bg-id-gold/10 flex items-center justify-center text-lg text-[#AA7C11] border border-id-gold/20">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>
        </div>

        <div class="studio-card p-6 mb-8">
            <div class="flex justify-between items-center mb-6 border-b border-slate-100 pb-4">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest"> Project Client Terbaru</h3>
                <a href="{{ route('admin.project.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors flex items-center gap-1">
                    Lihat Semua <i class="fa-solid fa-angle-right text-[10px]"></i>
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-black/[0.01] border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                            <th class="p-3 font-bold">Client</th>
                            <th class="p-3 font-bold">Layanan</th>
                            <th class="p-3 font-bold">Progress</th>
                            <th class="p-3 font-bold text-center">Status</th>
                            <th class="p-3 font-bold">Tanggal Transaksi</th>
                            <th class="p-3 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-[#2B2B30] font-medium">
                        @forelse($recentProjects as $project)
                            <tr class="hover:bg-white transition-colors">
                                <td class="p-3 font-bold text-slate-800">{{ $project->user->Nama ?? 'Client Resmi' }}</td>
                                <td class="p-3 text-slate-600">{{ $project->layanan->Nama_Layanan ?? $project->layanan->nama_layanan ?? 'Custom Project' }}</td>
                                <td class="p-3 w-44">
                                    <div class="flex items-center gap-2">
                                        <div class="flex-grow bg-slate-200 h-2 rounded-full overflow-hidden p-[1px]">
                                            <div class="bg-gradient-to-r from-[#D4AF37] to-[#AA7C11] h-full rounded-full transition-all" style="width: {{ $project->progress }}%"></div>
                                        </div>
                                        <span class="font-mono-atkinson text-[10px] text-slate-500 font-bold flex-shrink-0">{{ $project->progress }}%</span>
                                    </div>
                                </td>
                                <td class="p-3 text-center">
                                    @if($project->progress == 100)
                                        <span class="status-badge status-success">Selesai</span>
                                    @elseif($project->progress > 0)
                                        <span class="status-badge status-progress">Progress</span>
                                    @else
                                        <span class="status-badge status-pending">Pending</span>
                                    @endif
                                </td>
                                <td class="p-3 text-slate-500 font-mono-atkinson">{{ \Carbon\Carbon::parse($project->updated_at)->translatedFormat('d M Y') }}</td>
                                <td class="p-3 text-center">
                                    <a href="{{ route('admin.project.index') }}" class="text-slate-400 hover:text-slate-700 transition-colors"><i class="fa-solid fa-ellipsis"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-slate-400 italic">Belum ada transaksi proyek client yang tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="studio-card p-6">
                <h4 class="font-bold text-xs text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-3 mb-4"> Chat Support Terbaru</h4>
                <div class="space-y-3 max-h-[300px] overflow-y-auto custom-scroll pr-1">
                    @forelse($recentChats as $chatRoom)
                        <a href="{{ route('chat.index') }}" class="flex items-center gap-3 p-2.5 rounded-xl border border-transparent bg-white hover:border-slate-200 hover:shadow-sm transition-all block text-decoration-none">
                            <div class="w-8 h-8 rounded-lg bg-[#2B2B30] text-id-gold font-bold flex items-center justify-center text-[10px] flex-shrink-0">
                                {{ strtoupper(substr($chatRoom->user->Nama ?? 'CL', 0, 2)) }}
                            </div>
                            <div class="flex-grow min-w-0">
                                <p class="text-xs font-bold text-[#2B2B30] truncate">{{ $chatRoom->user->Nama ?? 'Client Resmi' }}</p>
                                <p class="text-[10px] text-slate-500 truncate font-medium mt-0.5">{{ $chatRoom->layanan->Nama_Layanan ?? $chatRoom->layanan->nama_layanan ?? 'Custom Project' }}</p>
                            </div>
                            <span class="text-[9px] font-mono-atkinson font-bold text-slate-400 bg-slate-100 px-1.5 py-0.5 rounded border border-slate-200 flex-shrink-0">#00{{ $chatRoom->id }}</span>
                        </a>
                    @empty
                        <p class="text-xs text-slate-400 italic py-6 text-center">Belum ada obrolan proyek aktif.</p>
                    @endforelse
                </div>
            </div>

            <div class="studio-card p-6">
                <h4 class="font-bold text-xs text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-3 mb-4"> File Project Terbaru</h4>
                <div class="space-y-3 max-h-[300px] overflow-y-auto custom-scroll pr-1">
                    @forelse($recentFiles as $file)
                        <div class="flex items-center justify-between p-2.5 rounded-xl border border-slate-100 bg-white shadow-sm">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-8 h-8 bg-slate-50 border border-slate-200 text-slate-500 rounded-lg flex items-center justify-center text-xs flex-shrink-0">
                                    <i class="fa-solid fa-file-shield"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-[#2B2B30] truncate max-w-[130px]">{{ $file->file_name }}</p>
                                    <p class="text-[9px] text-slate-400 font-mono-atkinson font-semibold mt-0.5">ROOM: #00{{ $file->transaction_id }}</p>
                                </div>
                            </div>
                            <a href="/storage stream/{{ $file->file_path }}" download class="w-7 h-7 rounded-lg bg-slate-50 hover:bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-800 transition-all"><i class="fa-solid fa-download text-[10px]"></i></a>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic py-6 text-center">Belum ada file produksi terunggah.</p>
                    @endforelse
                </div>
            </div>

            <div class="studio-card p-6">
                <h4 class="font-bold text-xs text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-3 mb-4"> Pemberitahuan Live</h4>
                <div class="space-y-3 max-h-[300px] overflow-y-auto custom-scroll pr-1 text-xs text-slate-600 font-medium">
                    @forelse($recentProjects->take(4) as $noti)
                        <div class="flex gap-2.5 items-start p-2 border-b border-slate-50">
                            <i class="fa-solid fa-circle-dot text-[#AA7C11] mt-1 flex-shrink-0 text-[8px]"></i>
                            <p class="leading-relaxed"><strong>Transaksi Baru Masuk</strong> dari {{ $noti->user->Nama ?? 'Client' }} untuk pemesanan jasa <span class="text-[#AA7C11] font-bold">{{ $noti->layanan->Nama_Layanan ?? $noti->layanan->nama_layanan }}</span>.</p>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic py-6 text-center">Tidak ada pemberitahuan log baru.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/todo.js') }}"></script>
</body>
</html>