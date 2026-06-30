<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tracking Workspace - Identra Studio</title>
    
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

        /* Sidebar Navigasi Kiri Konsisten */
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

        /* Pembungkus Konten Sebelah Kanan */
        .main-workspace {
            margin-left: 250px;
            padding: 32px 48px;
            min-height: 100vh;
        }

        /* Desain Card Studio */
        .studio-card {
            background-color: #FAFAFA;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.02);
        }

        /* Tombol Room Proyek Samping */
        .room-link {
            width: 100%;
            text-align: left;
            padding: 14px 16px;
            border-radius: 14px;
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            color: #2B2B30;
            transition: all 0.2s ease;
        }

        .room-link:hover {
            border-color: #D4AF37;
            background-color: #FFFFFF;
        }

        /* Notif Bell */
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

        /* KUSTOMISASI KONTRAS WARNA BALON CHAT */
        /* Balon Chat Admin / Developer (Sisi Kiri) */
        .chat-bubble-admin {
            background-color: #FFFFFF;
            border: 1px solid #DDE1E6;
            color: #1F2937 !important; /* Hitam Arang Pekat */
            font-weight: 550;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        /* Balon Chat Klien / Anda (Sisi Kanan) */
        .chat-bubble-client {
            background-color: #2B2B30; /* Charcoal Gelap Studio */
            color: #FFFFFF !important; /* Putih Bersih */
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        /* Modifikasi Scrollbar Internal */
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
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
                <a href="{{ route('transaction.index') }}" class="nav-link">
                    <i class="fa-solid fa-file-invoice-dollar w-5 text-center"></i> <span>Transaction</span>
                </a>
                <a href="{{ route('project.tracking') }}" class="nav-link active">
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
        
        <header class="flex justify-between items-center mb-10">
            <div class="space-y-0.5">
                <span class="text-[10px] font-mono-atkinson text-[#AA7C11] font-bold uppercase tracking-widest"> PRODUCTION MONITOR</span>
                <h1 class="text-3xl font-black text-[#2B2B30] tracking-tight">Tracking Project</h1>
                <p class="text-xs text-slate-600 font-semibold">Pantau perkembangan pengerjaan seluruh layanan agensi Anda secara real-time.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="util-btn shadow-sm">
                    <i class="fa-solid fa-bell text-sm"></i>
                </button>
            </div>
        </header>

        @if(!$hasPurchased)
            <div class="studio-card p-12 text-center max-w-md mx-auto my-12">
                <div class="w-14 h-14 bg-amber-500/10 text-[#AA7C11] border border-id-gold/20 rounded-xl flex items-center justify-center mx-auto mb-4 text-xl">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h3 class="text-base font-bold text-[#2B2B30] mb-1">Belum Ada Project Aktif</h3>
                <p class="text-xs text-slate-600 mb-6 px-4 font-medium leading-relaxed">Silakan lakukan konfirmasi pembayaran paket layanan kami untuk meluncurkan bilik monitoring pertama Anda.</p>
                <a href="{{ route('layanan.index') }}" class="inline-block bg-[#2B2B30] hover:bg-[#1E1E24] text-white text-xs px-6 py-3 rounded-xl font-bold transition-all shadow-sm active:scale-95">
                    Lihat Katalog Jasa
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-stretch">
                
                <div class="studio-card p-4 space-y-2.5 max-h-[600px] overflow-y-auto custom-scroll flex flex-col">
                    <h3 class="text-[10px] font-bold px-2 py-1 text-slate-500 uppercase tracking-widest border-b border-slate-200 mb-2"> Project Room Anda</h3>
                    
                    @foreach($allTransactions as $trx)
                        <button onclick="changeProjectRoom({{ $trx->id }})" 
                                id="room-btn-{{ $trx->id }}"
                                class="room-link flex items-center justify-between group cursor-pointer text-left">
                            <div class="min-w-0 flex-1 pr-2">
                                <p class="font-bold text-slate-800 group-hover:text-id-gold transition-colors truncate text-xs">
                                    {{ $trx->layanan->Nama_Layanan ?? $trx->layanan->nama_layanan ?? 'Custom Project' }}
                                </p>
                                <p class="text-[10px] text-slate-500 mt-0.5 font-mono-atkinson font-semibold">Progress: {{ $trx->progress }}%</p>
                            </div>
                            <span class="text-[9px] font-mono-atkinson font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded border border-slate-300">
                                #00{{ $trx->id }}
                            </span>
                        </button>
                    @endforeach
                </div>

                <div class="lg:col-span-3 grid grid-cols-1 lg:grid-cols-3 gap-6 relative min-h-[580px]">
                    
                    <div id="empty-workspace-state" class="absolute inset-0 bg-[#EFEFF2] border border-slate-200 rounded-2xl flex flex-col items-center justify-center text-center p-6 z-20">
                        <i class="fa-solid fa-folder-closed text-4xl text-slate-400 mb-3"></i>
                        <h4 class="font-bold text-sm text-[#2B2B30]">Buka Project Room</h4>
                        <p class="text-xs text-slate-600 max-w-xs mt-1 font-medium leading-normal">Silakan pilih salah satu bilik Project Room aktif Anda di panel sebelah kiri untuk memantau pengerjaan tim.</p>
                    </div>

                    <div class="lg:col-span-2 flex flex-col gap-6">
                        <div class="studio-card p-6 flex flex-col">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <span id="detail-badge-status" class="text-[9px] bg-id-gold/10 text-[#AA7C11] border border-id-gold/30 px-2.5 py-0.5 rounded font-black uppercase tracking-wider">-</span>
                                    <h2 id="detail-project-title" class="text-lg font-black mt-2 text-[#2B2B30] tracking-tight">-</h2>
                                </div>
                                <span id="detail-project-id" class="text-xs font-mono-atkinson font-bold text-slate-700 bg-slate-100 border border-slate-300 px-2.5 py-1 rounded-lg">-</span>
                            </div>

                            <div class="mb-2">
                                <div class="flex justify-between text-xs mb-1.5 font-semibold">
                                    <span class="text-slate-600">Persentase Pengerjaan</span>
                                    <span id="detail-progress-text" class="font-bold text-[#AA7C11]">0%</span>
                                </div>
                                <div class="w-full bg-slate-200 h-2.5 rounded-full overflow-hidden p-[1px] border border-slate-300">
                                    <div id="detail-progress-bar" class="bg-gradient-to-r from-[#D4AF37] to-[#AA7C11] h-full rounded-full transition-all duration-500" style="width: 0%"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 text-center text-[10px] text-slate-400 mt-6 pt-4 border-t border-slate-200 font-bold uppercase tracking-wider">
                                <div id="step-1" class="transition-all"><i class="fa-solid fa-file-invoice-dollar block text-sm mb-1"></i> Pembayaran</div>
                                <div id="step-2" class="transition-all"><i class="fa-solid fa-compass-drafting block text-sm mb-1"></i> Produksi</div>
                                <div id="step-3" class="transition-all"><i class="fa-solid fa-flag-checkered block text-sm mb-1"></i> Handover</div>
                            </div>
                        </div>

                        <div class="studio-card p-6 text-xs space-y-3 font-semibold">
                            <h4 class="font-bold text-xs mb-2 text-slate-500 uppercase tracking-widest"> Rincian Transaksi</h4>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-600">Nama Jasa Layanan:</span>
                                <span id="detail-rincian-nama" class="font-bold text-[#2B2B30]">-</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-600">Nilai Kontrak Terbayar:</span>
                                <span id="detail-rincian-harga" class="font-bold text-slate-800">-</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-600">Tanggal Modul Masuk:</span>
                                <span id="detail-rincian-tanggal" class="text-slate-700 font-mono-atkinson">-</span>
                            </div>
                        </div>

                        <div class="studio-card p-6 space-y-4 flex-grow">
                            <div class="flex items-center gap-2 border-b border-slate-200 pb-3">
                                <i class="fa-solid fa-box-archive text-[#AA7C11] text-sm"></i>
                                <h4 class="font-bold text-xs text-slate-500 uppercase tracking-widest">Berkas Asset Produksi</h4>
                            </div>
                            <div id="client-asset-container" class="space-y-2.5 max-h-[160px] overflow-y-auto custom-scroll pr-1"></div>
                        </div>
                    </div>

                    <div class="studio-card flex flex-col overflow-hidden border border-slate-200" style="height: 580px;">
                        <div class="p-4 border-b border-slate-200 bg-black/[0.01] flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-[#2B2B30] text-id-gold font-bold flex items-center justify-center text-xs border border-white/5">IS</div>
                            <div>
                                <h3 class="text-xs font-bold text-[#2B2B30]">Developer Team Support</h3>
                                <p class="text-[10px] text-emerald-700 flex items-center gap-1 font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Jalur Koordinasi Aktif
                                </p>
                            </div>
                        </div>

                        <div id="chat-box" class="flex-grow overflow-y-auto p-4 space-y-3 custom-scroll bg-[#F4F5F7]"></div>

                        <div class="p-3 border-t border-slate-200 bg-white flex gap-2 items-center">
                            <button onclick="document.getElementById('chat-file').click()" type="button" class="bg-slate-100 hover:bg-slate-200 text-slate-700 w-9 h-9 rounded-xl flex items-center justify-center text-xs transition-all flex-shrink-0 cursor-pointer">
                                <i class="fa-solid fa-paperclip"></i>
                            </button>
                            <input type="file" id="chat-file" class="hidden" onchange="sendFile()">
                            <input type="text" id="chat-input" placeholder="Ketik pesan koordinasi..." class="flex-grow bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs text-[#2B2B30] focus:outline-none focus:border-id-gold/40 placeholder:text-slate-400 transition-all font-medium">
                            
                            <button onclick="sendChat()" id="btn-send-chat" class="bg-[#2B2B30] hover:bg-[#1E1E24] text-white w-9 h-9 rounded-xl flex items-center justify-center text-xs font-bold transition-all shadow active:scale-95 flex-shrink-0 cursor-pointer">
                                <i class="fa-solid fa-paper-plane text-id-gold"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </main>

    <script>
        let currentActiveRoomId = null;

        function changeProjectRoom(id) {
            currentActiveRoomId = id;
            
            // 1. Sembunyikan Tirai Empty State
            document.getElementById('empty-workspace-state').classList.add('hidden');

            // 2. Ubah Highlight Tombol Aktif di Sisi Kiri
            document.querySelectorAll('.room-link').forEach(el => {
                el.classList.remove('bg-white', 'border-l-4', 'border-id-gold', 'shadow-sm');
            });
            
            const activeBtn = document.getElementById('room-btn-' + id);
            if(activeBtn) {
                activeBtn.classList.add('bg-white', 'border-l-4', 'border-id-gold', 'shadow-sm');
            }

            // 3. Tarik Data Detail Transaksi Proyek Melalui API via Ajax
            fetch('/api/tracking/detail/' + id)
                .then(res => res.json())
                .then(data => {
                    // Update Text & Atribut Komponen Progress
                    document.getElementById('detail-badge-status').innerText = data.status;
                    document.getElementById('detail-project-title').innerText = data.layanan ? (data.layanan.Nama_Layanan || data.layanan.nama_layanan) : 'Custom Project';
                    document.getElementById('detail-project-id').innerText = "ROOM: #00" + data.id;
                    document.getElementById('detail-progress-text').innerText = data.progress + "%";
                    document.getElementById('detail-progress-bar').style.width = data.progress + "%";

                    // Ganti Warna Indikator Jalur Langkah
                    resetStepColors();
                    if(data.progress >= 10) document.getElementById('step-1').className = "text-[#AA7C11] font-bold";
                    if(data.progress >= 50) document.getElementById('step-2').className = "text-[#AA7C11] font-bold";
                    if(data.progress >= 100) document.getElementById('step-3').className = "text-[#AA7C11] font-bold";

                    // Update Rincian Transaksi
                    document.getElementById('detail-rincian-nama').innerText = data.layanan ? (data.layanan.Nama_Layanan || data.layanan.nama_layanan) : 'Custom Project';
                    document.getElementById('detail-rincian-harga').innerText = "Rp " + new Intl.NumberFormat('id-ID').format(data.amount);
                    document.getElementById('detail-rincian-tanggal').innerText = new Date(data.created_at).toLocaleString('id-ID') + " WIB";

                    // Ambil Berkas File Produksi Milik Kamar Ini
                    loadSpecificAssets(data.id);

                    // Sinkronisasi Kunci Room Id Global untuk Keperluan Chat
                    if (typeof window.setChatRoomId === "function") {
                        window.setChatRoomId(data.id); 
                    }
                });
        }

        function resetStepColors() {
            ['step-1', 'step-2', 'step-3'].forEach(id => {
                const el = document.getElementById(id);
                if(el) el.className = "text-slate-400 font-semibold";
            });
        }

        function loadSpecificAssets(transactionId) {
            const assetContainer = document.getElementById('client-asset-container');
            fetch('/api/project-assets/' + transactionId)
                .then(res => res.json())
                .then(data => {
                    assetContainer.innerHTML = '';
                    if (data.length === 0) {
                        assetContainer.innerHTML = `<p class="text-[11px] text-slate-500 font-medium italic text-center py-6">Belum ada berkas hasil produksi resmi di room ini.</p>`;
                        return;
                    }
                    data.forEach(asset => {
                        assetContainer.innerHTML += `
                            <div class="flex justify-between items-center bg-white border border-slate-200 p-3 rounded-xl hover:border-id-gold/30 transition-all shadow-sm">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <div class="w-8 h-8 bg-slate-50 border border-slate-200 text-slate-700 rounded-lg flex items-center justify-center text-xs flex-shrink-0">
                                        <i class="fa-solid fa-file-shield"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-bold text-[#2B2B30] truncate max-w-[160px]">${asset.file_name}</p>
                                        <p class="text-[9px] text-slate-500 font-mono-atkinson font-semibold uppercase tracking-tight">${asset.file_size || 'N/A'}</p>
                                    </div>
                                </div>
                                <a href="/storage/${asset.file_path}" download="${asset.file_name}" target="_blank" class="text-[10px] font-bold text-slate-700 hover:text-black bg-slate-100 hover:bg-slate-200 border border-slate-200 px-3 py-1.5 rounded-lg transition-all flex items-center gap-1 cursor-pointer">
                                    <i class="fa-solid fa-download"></i> Get File
                                </a>
                            </div>`;
                    });
                });
        }
    </script>
    <script src="{{ asset('js/chat-tracking.js') }}"></script>
</body>
</html>