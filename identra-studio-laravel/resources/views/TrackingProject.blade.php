<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tracking Project - Identra Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#0b0a14] text-white font-sans min-h-screen">

    <div class="max-w-7xl mx-auto px-4 py-8">
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Tracking Project</h1>
                <p class="text-xs text-gray-400">Pantau perkembangan pengerjaan seluruh layanan agensi Anda</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-xs bg-white/5 hover:bg-white/10 px-4 py-2 rounded-xl border border-white/10 transition-all flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        @if(!$hasPurchased)
            <div class="bg-white/5 border border-white/10 rounded-2xl p-12 text-center max-w-md mx-auto my-12 shadow-xl">
                <div class="w-16 h-16 bg-purple-600/20 text-purple-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h3 class="text-lg font-bold mb-1">Belum Ada Project Aktif</h3>
                <p class="text-xs text-gray-400 mb-6 px-4">Silakan lakukan konsultasi atau pilih paket layanan kami untuk memulai project pertama Anda bersama Identra Studio.</p>
                <a href="{{ route('layanan.index') }}" class="inline-block bg-purple-600 hover:bg-purple-700 text-white text-xs px-6 py-3 rounded-xl font-bold transition-all shadow-md">
                    Lihat Katalog Jasa
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
                
                <div class="bg-white/5 border border-white/10 rounded-2xl p-4 shadow-xl space-y-2 max-h-[600px] overflow-y-auto">
                    <h3 class="text-xs font-bold px-2 mb-3 text-gray-400 uppercase tracking-wider">Project Room Anda</h3>
                    @foreach($allTransactions as $index => $trx)
                        <button onclick="changeProjectRoom({{ $trx->id }})" 
                            id="room-btn-{{ $trx->id }}"
                            class="room-link w-full text-left p-3.5 rounded-xl border border-white/5 bg-white/[0.01] hover:bg-white/5 transition-all flex items-center justify-between text-xs group">
                            <div class="min-w-0 pr-2">
                                <p class="font-bold text-white group-hover:text-purple-400 transition-colors truncate">
                                    {{ $trx->layanan->Nama_Layanan ?? $trx->layanan->nama_layanan ?? 'Custom Project' }}
                                </p>
                                <p class="text-[10px] text-gray-400 mt-0.5 font-mono">Progress: {{ $trx->progress }}%</p>
                            </div>
                            <span class="text-[10px] font-mono text-purple-300 bg-purple-500/10 px-2 py-0.5 rounded flex-shrink-0">
                                #00{{ $trx->id }}
                            </span>
                        </button>
                    @endforeach
                </div>

                <div class="lg:col-span-3 grid grid-cols-1 lg:grid-cols-3 gap-6 relative min-h-[600px]">
                    
                    <div id="empty-workspace-state" class="absolute inset-0 bg-[#0b0a14] border border-white/5 rounded-2xl flex flex-col items-center justify-center text-center p-6 z-20">
                        <i class="fa-solid fa-folder-closed text-5xl text-purple-500/20 mb-3 animate-pulse"></i>
                        <h4 class="font-bold text-sm">Buka Project Room</h4>
                        <p class="text-xs text-gray-400 max-w-xs mt-1">Silakan pilih salah satu daftar Project Room aktif Anda di panel sebelah kiri untuk memantau progress pengerjaan.</p>
                    </div>

                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 shadow-xl">
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <span id="detail-badge-status" class="text-[10px] bg-purple-600/20 text-purple-400 border border-purple-500/30 px-3 py-1 rounded-full font-bold uppercase tracking-wider">-</span>
                                    <h2 id="detail-project-title" class="text-lg font-bold mt-2">-</h2>
                                </div>
                                <span id="detail-project-id" class="text-sm font-black text-purple-400 bg-purple-500/10 px-3 py-1 rounded-lg">-</span>
                            </div>

                            <div class="mb-4">
                                <div class="flex justify-between text-xs mb-2">
                                    <span class="text-gray-400 font-medium">Persentase Pengerjaan</span>
                                    <span id="detail-progress-text" class="font-bold text-purple-400">0%</span>
                                </div>
                                <div class="w-full bg-white/10 h-3 rounded-full overflow-hidden p-[2px] border border-white/5">
                                    <div id="detail-progress-bar" class="bg-gradient-to-r from-purple-500 to-indigo-500 h-full rounded-full transition-all duration-500" style="width: 0%"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 text-center text-[10px] text-gray-400 mt-6 pt-4 border-t border-white/5">
                                <div id="step-1"><i class="fa-solid fa-file-invoice-dollar block text-sm mb-1"></i> Pembayaran</div>
                                <div id="step-2"><i class="fa-solid fa-compass-drafting block text-sm mb-1"></i> Proses Desain</div>
                                <div id="step-3"><i class="fa-solid fa-flag-checkered block text-sm mb-1"></i> Handover/Selesai</div>
                            </div>
                        </div>

                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-xs space-y-3 shadow-xl">
                            <h4 class="font-bold text-sm mb-2 text-gray-300">Rincian Transaksi</h4>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Nama Layanan:</span>
                                <span id="detail-rincian-nama" class="font-bold text-purple-400">-</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Total Pembayaran:</span>
                                <span id="detail-rincian-harga" class="font-bold text-emerald-400">-</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Tanggal Transaksi:</span>
                                <span id="detail-rincian-tanggal">-</span>
                            </div>
                        </div>

                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 shadow-xl space-y-4">
                            <div class="flex items-center gap-2 border-b border-white/5 pb-3">
                                <i class="fa-solid fa-box-archive text-purple-400 text-sm"></i>
                                <h4 class="font-bold text-sm text-gray-200">Berkas Hasil Production & Asset</h4>
                            </div>
                            <div id="client-asset-container" class="space-y-3 max-h-[180px] overflow-y-auto pr-1">
                                </div>
                        </div>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-2xl flex flex-col shadow-xl overflow-hidden" style="height: 560px;">
                        <div class="p-4 border-b border-white/10 bg-white/[0.02] flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center font-bold text-xs shadow">IS</div>
                            <div>
                                <h3 class="text-xs font-bold">Admin Identra Studio</h3>
                                <p class="text-[10px] text-emerald-400 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Online Support
                                </p>
                            </div>
                        </div>

                        <div id="chat-box" class="flex-grow overflow-y-auto p-4 space-y-3">
                            </div>

                        <div class="p-3 border-t border-white/10 bg-white/[0.01] flex gap-2 items-center">
                            <button onclick="document.getElementById('chat-file').click()" type="button" class="bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white w-9 h-9 rounded-xl flex items-center justify-center text-xs transition-all flex-shrink-0">
                                <i class="fa-solid fa-paperclip"></i>
                            </button>
                            <input type="file" id="chat-file" class="hidden" onchange="sendFile()">
                            <input type="text" id="chat-input" placeholder="Ketik pesan..." class="flex-grow bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-purple-500/50 placeholder:text-gray-500 transition-all">
                            <button onclick="sendChat()" id="btn-send-chat" class="bg-purple-600 hover:bg-purple-700 text-white w-9 h-9 rounded-xl flex items-center justify-center text-xs font-bold transition-all shadow-md flex-shrink-0">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </div>

    <script>
        let currentActiveRoomId = null;

        function changeProjectRoom(id) {
            currentActiveRoomId = id;
            
            // 1. Sembunyikan Tirai Empty State
            document.getElementById('empty-workspace-state').classList.add('hidden');

            // 2. Ubah Highlight Tombol Aktif di Sisi Kiri
            document.querySelectorAll('.room-link').forEach(el => {
                el.classList.remove('bg-white/10', 'border-l-4', 'border-purple-500');
            });
            document.getElementById('room-btn-' + id).classList.add('bg-white/10', 'border-l-4', 'border-purple-500');

            // 3. Tarik Data Detail Transaksi Proyek Melalui API via Ajax
            fetch('/api/tracking/detail/' + id)
                .then(res => res.json())
                .then(data => {
                    // Update Text & Atribut Komponen Progress
                    document.getElementById('detail-badge-status').innerText = data.status;
                    document.getElementById('detail-project-title').innerText = data.layanan ? (data.layanan.Nama_Layanan || data.layanan.nama_layanan) : 'Custom Project';
                    document.getElementById('detail-project-id').innerText = "ID: #00" + data.id;
                    document.getElementById('detail-progress-text').innerText = data.progress + "%";
                    document.getElementById('detail-progress-bar').style.width = data.progress + "%";

                    // Ganti Warna Indikator Jalur Langkah
                    resetStepColors();
                    if(data.progress >= 10) document.getElementById('step-1').classList.add('text-purple-400', 'font-bold');
                    if(data.progress >= 50) document.getElementById('step-2').classList.add('text-purple-400', 'font-bold');
                    if(data.progress >= 100) document.getElementById('step-3').classList.add('text-purple-400', 'font-bold');

                    // Update Rincian Transaksi
                    document.getElementById('detail-rincian-nama').innerText = data.layanan ? (data.layanan.Nama_Layanan || data.layanan.nama_layanan) : 'Custom Project';
                    document.getElementById('detail-rincian-harga').innerText = "Rp " + new Intl.NumberFormat('id-ID').format(data.amount);
                    document.getElementById('detail-rincian-tanggal').innerText = new Date(data.created_at).toLocaleString('id-ID') + " WIB";

                    // Ambil Berkas File Produksi Milik Kamar Ini
                    loadSpecificAssets(data.id);

                    // Sinkronisasi Kunci Room Id Global untuk Keperluan Chat Anda jika dibutuhkan
                    if (typeof window.setChatRoomId === "function") {
                        window.setChatRoomId(data.id); 
                    }
                });
        }

        function resetStepColors() {
            ['step-1', 'step-2', 'step-3'].forEach(id => {
                document.getElementById(id).className = "";
            });
        }

        function loadSpecificAssets(transactionId) {
            const assetContainer = document.getElementById('client-asset-container');
            fetch('/api/project-assets/' + transactionId)
                .then(res => res.json())
                .then(data => {
                    assetContainer.innerHTML = '';
                    if (data.length === 0) {
                        assetContainer.innerHTML = `<p class="text-[11px] text-gray-500 italic text-center py-4">Belum ada berkas hasil produksi resmi di room ini.</p>`;
                        return;
                    }
                    data.forEach(asset => {
                        assetContainer.innerHTML += `
                            <div class="flex justify-between items-center bg-white/[0.02] border border-white/5 p-3 rounded-xl hover:bg-white/5 transition-all">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <div class="w-8 h-8 bg-purple-600/10 border border-purple-500/20 text-purple-400 rounded-lg flex items-center justify-center text-xs flex-shrink-0">
                                        <i class="fa-solid fa-file-shield"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-bold text-white truncate max-w-[160px]">${asset.file_name}</p>
                                        <p class="text-[10px] text-gray-400 uppercase tracking-tight">${asset.file_size}</p>
                                    </div>
                                </div>
                                <a href="/storage/${asset.file_path}" download="${asset.file_name}" target="_blank" class="text-[10px] font-bold text-purple-300 hover:text-white bg-purple-600/10 hover:bg-purple-600 border border-purple-500/20 px-3 py-1.5 rounded-lg transition-all flex items-center gap-1">
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