<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>File & Asset Management - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Styling navigasi sidebar khas Identra Studio */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            color: #9ca3af;
            transition: all 0.2s;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
        }
        .nav-link.active {
            background-color: rgba(147, 51, 234, 0.1);
            border-left: 4px solid #a855f7;
            color: #c084fc;
            font-weight: bold;
        }
        .nav-link i {
            width: 1.25rem;
            text-align: center;
        }
    </style>
</head>
<body class="bg-[#0b0a14] text-white font-sans min-h-screen flex">

    <aside class="w-64 bg-[#11101e] border-r border-white/10 p-6 flex flex-col min-h-screen flex-shrink-0">
        <div class="mb-8 px-2">
            <h1 class="text-xl font-black bg-gradient-to-r from-purple-400 to-indigo-400 bg-clip-text text-transparent tracking-wider">
                IDENTRA <span class="text-white text-xs font-light block tracking-normal text-gray-400">Admin Workspace</span>
            </h1>
        </div>

        <nav class="flex-grow space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fa-solid fa-chart-line"></i><span>Dashboard</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-users-gear"></i><span>User Management</span>
            </a>
            <a href="{{ route('admin.layanan.index') }}" class="nav-link">
                <i class="fa-solid fa-boxes-packing"></i><span>Layanan</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-file-invoice-dollar"></i><span>Transaksi</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-briefcase"></i><span>Project Client</span>
            </a>
            
            <a href="{{ route('admin.asset.index') }}" class="nav-link active">
                <i class="fa-solid fa-folder-open"></i><span>File & Asset</span>
            </a>
            
            <a href="{{ route('chat.index') }}" class="nav-link">
                <i class="fa-solid fa-comments"></i><span>Chat Support</span>
            </a>
        </nav>

        <div class="border-t border-white/10 pt-4 mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left nav-link text-red-400 hover:bg-red-500/10 hover:text-red-300">
                    <i class="fa-solid fa-right-from-bracket"></i><span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-grow p-8 overflow-y-auto">
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">File & Asset Management</h1>
                <p class="text-xs text-gray-400">Unggah dan koordinasikan berkas hasil produksi resmi dengan client</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-xs bg-white/5 hover:bg-white/10 px-4 py-2 rounded-xl border border-white/10 transition-all">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 shadow-xl space-y-2 max-h-[550px] overflow-y-auto">
                <h3 class="text-sm font-bold px-2 mb-4 text-gray-400">Project Client Aktif</h3>
                @foreach($activeProjects as $project)
                    <button onclick="selectProject({{ $project->id }}, '{{ $project->layanan->Nama_Layanan ?? $project->layanan->nama_layanan }}', '{{ $project->user->Nama }}')" 
                        id="project-btn-{{ $project->id }}"
                        class="project-link w-full text-left p-3 rounded-xl border border-white/5 bg-white/[0.02] hover:bg-white/5 transition-all flex items-center justify-between text-xs">
                        <div class="min-w-0 pr-2">
                            <p class="font-bold text-white truncate">{{ $project->user->Nama }}</p>
                            <p class="text-[11px] text-gray-400 mt-0.5 truncate">{{ $project->layanan->Nama_Layanan ?? $project->layanan->nama_layanan }}</p>
                        </div>
                        <span class="text-[10px] font-mono text-purple-400 bg-purple-500/10 px-2 py-0.5 rounded flex-shrink-0">#00{{ $project->id }}</span>
                    </button>
                @endforeach
            </div>

            <div class="lg:col-span-2 bg-white/5 border border-white/10 rounded-2xl flex flex-col shadow-xl overflow-hidden relative" style="height: 550px;">
                
                <div id="empty-state" class="absolute inset-0 bg-[#12111f] flex flex-col items-center justify-center text-center p-6 z-10">
                    <i class="fa-solid fa-folder-closed text-5xl text-purple-500/30 mb-4 animate-bounce"></i>
                    <h4 class="font-bold text-sm">Pilih Project Client</h4>
                    <p class="text-xs text-gray-400 max-w-xs mt-1">Silakan pilih salah satu proyek aktif di sebelah kiri untuk mengelola berkas hasil produksi.</p>
                </div>

                <div class="p-4 border-b border-white/10 bg-white/[0.02] flex justify-between items-center">
                    <div>
                        <h3 id="active-project-title" class="text-xs font-bold text-white">-</h3>
                        <p id="active-client-name" class="text-[10px] text-purple-400 mt-0.5">-</p>
                    </div>
                    <button onclick="document.getElementById('upload-input').click()" class="bg-purple-600 hover:bg-purple-700 text-white text-[11px] px-4 py-2 rounded-xl font-bold transition-all flex items-center gap-1.5 shadow">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Upload Berkas Baru
                    </button>
                    <input type="file" id="upload-input" class="hidden" onchange="uploadAssetFile()">
                </div>

                <div id="asset-list-container" class="flex-grow overflow-y-auto p-4 space-y-3">
                </div>
            </div>

        </div>
    </main>

    <script src="{{ asset('js/file-asset.js') }}"></script>
</body>
</html>