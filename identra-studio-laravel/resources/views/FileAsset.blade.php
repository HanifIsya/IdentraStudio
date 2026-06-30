<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>File & Asset Management - Admin Headquarters</title>
    
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

        /* Tombol List Proyek Klien di Sisi Kiri */
        .project-link {
            width: 100%;
            text-align: left;
            padding: 14px 16px;
            border-radius: 14px;
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            color: #2B2B30;
            transition: all 0.2s ease;
        }

        .project-link:hover {
            border-color: #D4AF37;
            background-color: #FFFFFF;
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

        /* Modifikasi Scrollbar Internal */
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
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
            <a href="{{ route('admin.project.index') }}" class="nav-link">
                <i class="fa-solid fa-briefcase w-5 text-center"></i> <span>Project Client</span>
            </a>
            <a href="{{ route('admin.asset.index') }}" class="nav-link active">
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
                <span class="text-[10px] font-mono-atkinson text-id-gold font-bold uppercase tracking-widest"> PRODUCTION FILE DELIVERY</span>
                <h1 class="text-3xl font-black text-[#2B2B30] tracking-tight">File & Asset Management</h1>
                <p class="text-xs text-slate-500 font-medium">Unggah, distribusikan, dan koordinasikan berkas hasil produksi resmi dengan client.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="util-btn shadow-sm">
                    <i class="fa-solid fa-bell text-sm"></i>
                </button>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-stretch">
            
            <div class="studio-card p-4 space-y-2.5 max-h-[550px] overflow-y-auto custom-scroll flex flex-col">
                <h3 class="text-[10px] font-bold px-2 py-1 text-slate-400 uppercase tracking-widest border-b border-slate-100 mb-2"> Project Client Aktif</h3>
                
                @foreach($activeProjects as $project)
                    <button onclick="selectProject({{ $project->id }}, '{{ $project->layanan->Nama_Layanan ?? $project->layanan->nama_layanan ?? 'Custom Project' }}', '{{ $project->user->Nama }}')" 
                            id="project-btn-{{ $project->id }}"
                            class="project-link flex items-center justify-between group cursor-pointer text-left">
                        <div class="min-w-0 flex-1 pr-2">
                            <p class="font-bold text-slate-800 group-hover:text-id-gold transition-colors truncate text-xs">
                                {{ $project->user->Nama }}
                            </p>
                            <p class="text-[10px] text-slate-500 mt-0.5 font-medium truncate">
                                {{ $project->layanan->Nama_Layanan ?? $project->layanan->nama_layanan ?? 'Custom Project' }}
                            </p>
                        </div>
                        <span class="text-[9px] font-mono-atkinson font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded border border-slate-300">
                            #00{{ $project->id }}
                        </span>
                    </button>
                @endforeach
            </div>

            <div class="lg:col-span-3 studio-card flex flex-col shadow-xl overflow-hidden relative" style="height: 550px;">
                
                <div id="empty-state" class="absolute inset-0 bg-[#EFEFF2] border border-slate-200 rounded-2xl flex flex-col items-center justify-center text-center p-6 z-10">
                    <i class="fa-solid fa-folder-closed text-4xl text-slate-400 mb-3"></i>
                    <h4 class="font-bold text-sm text-[#2B2B30]">Pilih Project Client</h4>
                    <p class="text-xs text-slate-500 max-w-xs mt-1 font-medium leading-normal">Silakan pilih salah satu proyek aktif di sebelah kiri untuk mengelola rincian berkas hasil produksi.</p>
                </div>

                <div class="p-5 border-b border-slate-200 bg-black/[0.005] flex justify-between items-center flex-wrap gap-4">
                    <div class="min-w-0">
                        <h3 id="active-project-title" class="text-sm font-black text-[#2B2B30] tracking-tight truncate">-</h3>
                        <p id="active-client-name" class="text-[11px] text-[#AA7C11] font-bold mt-0.5">-</p>
                    </div>
                    <button onclick="document.getElementById('upload-input').click()" class="bg-[#2B2B30] hover:bg-[#1E1E24] text-white text-xs uppercase tracking-widest font-black py-3 px-4 rounded-xl transition-all shadow flex items-center gap-1.5 active:scale-95 cursor-pointer">
                        <i class="fa-solid fa-cloud-arrow-up text-id-gold"></i> Upload Berkas Baru
                    </button>
                    <input type="file" id="upload-input" class="hidden" onchange="uploadAssetFile()">
                </div>

                <div id="asset-list-container" class="flex-grow overflow-y-auto p-5 space-y-3 custom-scroll bg-[#F4F5F7]"></div>
            </div>

        </div>
    </main>

    <script src="{{ asset('js/file-asset.js') }}"></script>
</body>
</html>