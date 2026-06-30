<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat Support Admin - Admin Headquarters</title>
    
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

        /* Pembungkus Utama Area Kerja Chat Split Screen */
        .main-workspace-chat {
            margin-left: 250px;
            display: flex;
            height: 100vh;
            width: calc(100% - 250px);
        }

        /* Container Card Style Studio */
        .studio-card {
            background-color: #FAFAFA;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.02);
        }

        /* Navigasi List Tombol Kamar Room Chat Samping */
        .user-chat-link {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            color: #2B2B30;
            transition: all 0.2s ease;
        }
        .user-chat-link:hover {
            border-color: #D4AF37;
        }

        /* KUSTOMISASI KONTRAS BALON CHAT BARU */
        /* Balon Chat Client/User (Sisi Kiri di Layar Admin) */
        .chat-bubble-admin {
            background-color: #FFFFFF;
            border: 1px solid #DDE1E6;
            color: #1F2937 !important; /* Hitam Arang Pekat */
            font-weight: 550;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        /* Balon Chat Admin/Diri Sendiri (Sisi Kanan di Layar Admin) */
        .chat-bubble-client {
            background-color: #2B2B30; /* Charcoal Gelap Studio */
            color: #FFFFFF !important; /* Putih Bersih */
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
    </style>
</head>
<body class="min-h-screen overflow-hidden">

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
            <a href="{{ route('admin.asset.index') }}" class="nav-link">
                <i class="fa-solid fa-folder-open w-5 text-center"></i> <span>File & Asset</span>
            </a>
            <a href="{{ route('chat.index') }}" class="nav-link active">
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

    <main class="main-workspace-chat">
        
        <div class="w-80 border-r border-slate-200 bg-[#FAFAFA] flex flex-col flex-shrink-0">
            <div class="p-6 border-b border-slate-200 bg-black/[0.005]">
                <h2 class="text-sm font-black uppercase text-slate-400 tracking-wider"> Chat Room Proyek</h2>
                <p class="text-xs text-slate-500 mt-1 font-semibold leading-normal">Pilih salah satu bilik room proyek aktif untuk membalas pesan.</p>
            </div>
            
            <div class="flex-grow overflow-y-auto p-4 space-y-2.5 custom-scroll">
                @forelse($chatRooms as $room)
                    <button onclick="selectProjectRoom({{ $room->id }}, '{{ $room->user->Nama ?? 'Client' }}', '{{ $room->layanan->Nama_Layanan ?? $room->layanan->nama_layanan ?? 'Custom Project' }}')" 
                            id="room-btn-{{ $room->id }}"
                            class="user-chat-link w-full text-left flex items-center gap-3 p-3.5 rounded-xl transition-all group cursor-pointer shadow-sm">
                        <div class="w-9 h-9 rounded-xl bg-[#2B2B30] text-id-gold font-bold flex items-center justify-center text-[11px] flex-shrink-0 border border-white/5">
                            {{ strtoupper(substr($room->user->Nama ?? 'CL', 0, 2)) }}
                        </div>
                        <div class="flex-grow min-w-0">
                            <p class="text-xs font-bold text-slate-800 truncate group-hover:text-id-gold transition-colors">{{ $room->user->Nama ?? 'Client Resmi' }}</p>
                            <p class="text-[10px] text-slate-400 truncate mt-0.5 font-medium">{{ $room->layanan->Nama_Layanan ?? $room->layanan->nama_layanan ?? 'Custom Project' }}</p>
                            <span class="inline-block text-[9px] font-mono-atkinson font-bold text-slate-400 bg-slate-100 border border-slate-200 px-1.5 py-0.5 rounded mt-1.5">#00{{ $room->id }}</span>
                        </div>
                    </button>
                @empty
                    <p class="text-xs text-center text-slate-400 font-medium italic mt-8">Belum ada room proyek aktif.</p>
                @endforelse
            </div>
        </div>

        <div class="flex-grow flex flex-col bg-white relative">
            
            <div id="empty-chatroom" class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 z-10 bg(#EFEFF2)">
                <i class="fa-solid fa-comments text-4xl text-slate-300 mb-3"></i>
                <h3 class="text-sm font-bold text-[#2B2B30]">Pilih Ruang Obrolan</h3>
                <p class="text-xs text-slate-500 max-w-xs mt-1 font-medium leading-normal">Klik salah satu kamar proyek aktif di panel sebelah kiri untuk memulai koordinasi bimbingan pengerjaan.</p>
            </div>

            <div class="p-4 md:p-5 border-b border-slate-200 bg-black/[0.005] flex items-center gap-3 flex-shrink-0">
                <div class="w-9 h-9 rounded-xl bg-[#2B2B30] text-id-gold font-bold flex items-center justify-center text-xs border border-white/5" id="active-user-avatar">
                    ??
                </div>
                <div>
                    <h3 class="text-sm font-bold text-[#2B2B30]" id="active-user-name">Memuat Klien...</h3>
                    <p class="text-[10px] text-[#AA7C11] font-bold" id="active-project-name">Koordinasi Project Agency</p>
                </div>
            </div>

            <div id="admin-chat-box" class="flex-grow overflow-y-auto p-5 space-y-3.5 custom-scroll bg-[#F4F5F7]"></div>

            <div class="p-4 border-t border-slate-200 bg-white flex gap-2 items-center flex-shrink-0">
                <input type="text" id="admin-chat-input" placeholder="Tulis instruksi atau balasan bimbingan Anda..." 
                    class="flex-grow bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-xs text-[#2B2B30] focus:outline-none focus:border-id-gold/40 placeholder:text-slate-400 font-medium transition-all">
                <button onclick="sendAdminChat()" class="bg-[#2B2B30] hover:bg-[#1E1E24] text-white w-12 h-10 rounded-xl flex items-center justify-center transition-all shadow active:scale-95 flex-shrink-0 cursor-pointer">
                    <i class="fa-solid fa-paper-plane text-id-gold text-xs"></i>
                </button>
            </div>
        </div>

    </main>

    <script>
        let currentActiveTransactionId = null;

        function selectProjectRoom(id, clientName, projectName) {
            currentActiveTransactionId = id;
            
            // Sembunyikan tirai penutup awal
            document.getElementById('empty-chatroom').classList.add('hidden');

            // Set Header Detail Kamar Proyek aktif
            document.getElementById('active-user-name').innerText = clientName;
            document.getElementById('active-project-name').innerText = projectName + " (#00" + id + ")";
            document.getElementById('active-user-avatar').innerText = clientName.substring(0, 2).toUpperCase();

            // Toggle Class Highlight List Sisi Kiri
            document.querySelectorAll('.user-chat-link').forEach(btn => {
                btn.classList.remove('bg-white', 'border-l-4', 'border-id-gold', 'shadow-sm');
            });
            
            const activeBtn = document.getElementById('room-btn-' + id);
            if(activeBtn) {
                activeBtn.classList.add('bg-white', 'border-l-4', 'border-id-gold', 'shadow-sm');
            }

            // Daftarkan target ID ke fungsi eksternal js/chat-admin.js
            if (typeof window.setAdminActiveRoom === "function") {
                window.setAdminActiveRoom(id);
            } else if (typeof loadAdminRoomMessages === "function") {
                loadAdminRoomMessages(id);
            }
        }
    </script>
    <script src="{{ asset('js/chat-admin.js') }}"></script>
</body>
</html>