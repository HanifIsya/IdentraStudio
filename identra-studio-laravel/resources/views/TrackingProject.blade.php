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

    <div class="max-w-6xl mx-auto px-4 py-8">
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Tracking Project</h1>
                <p class="text-xs text-gray-400">Pantau perkembangan pengerjaan layanan agensi Anda</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-xs bg-white/5 hover:bg-white/10 px-4 py-2 rounded-xl border border-white/10 transition-all">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
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
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 shadow-xl">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <span class="text-[10px] bg-purple-600/20 text-purple-400 border border-purple-500/30 px-3 py-1 rounded-full font-bold uppercase tracking-wider">
                                    {{ $transaction->status ?? 'PAID' }}
                                </span>
                                <h2 class="text-lg font-bold mt-2">Project Website & Branding Studio</h2>
                            </div>
                            <span class="text-sm font-black text-purple-400 bg-purple-500/10 px-3 py-1 rounded-lg">ID: #{{ substr($transaction->external_id ?? 'IDN-001', -8) }}</span>
                        </div>

                        <div class="mb-4">
                            <div class="flex justify-between text-xs mb-2">
                                <span class="text-gray-400 font-medium">Persentase Pengerjaan</span>
                                <span class="font-bold text-purple-400">{{ $progress }}%</span>
                            </div>
                            <div class="w-full bg-white/10 h-3 rounded-full overflow-hidden p-[2px] border border-white/5">
                                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 h-full rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 text-center text-[10px] text-gray-400 mt-6 pt-4 border-t border-white/5">
                            <div class="{{ $progress >= 10 ? 'text-purple-400 font-bold' : '' }}">
                                <i class="fa-solid fa-file-invoice-dollar block text-sm mb-1"></i> Pembayaran
                            </div>
                            <div class="{{ $progress >= 50 ? 'text-purple-400 font-bold' : '' }}">
                                <i class="fa-solid fa-compass-drafting block text-sm mb-1"></i> Proses Desain
                            </div>
                            <div class="{{ $progress >= 100 ? 'text-purple-400 font-bold' : '' }}">
                                <i class="fa-solid fa-flag-checkered block text-sm mb-1"></i> Handover/Selesai
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-xs space-y-3">
                        <h4 class="font-bold text-sm mb-2 text-gray-300">Rincian Transaksi</h4>
                        <div class="flex justify-between"><span class="text-gray-400">Total Pembayaran:</span><span class="font-bold text-emerald-400">Rp {{ number_format($transaction->amount ?? 3500000, 0, ',', '.') }}</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Tanggal Transaksi:</span><span>{{ $transaction->created_at ?? now()->format('Y-m-d') }}</span></div>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl flex flex-col shadow-xl overflow-hidden" style="height: 480px;">
                    <div class="p-4 border-b border-white/10 bg-white/[0.02] flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center font-bold text-xs shadow">
                            IS
                        </div>
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
                        <input type="text" id="chat-input" placeholder="Ketik pesan ke admin..." 
                            class="flex-grow bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-purple-500/50 placeholder:text-gray-500 transition-all">
                        
                        <button onclick="sendChat()" id="btn-send-chat" 
                            class="bg-purple-600 hover:bg-purple-700 text-white w-9 h-9 rounded-xl flex items-center justify-center text-xs font-bold transition-all shadow-md active:scale-95">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </div>

            </div>
        @endif

    </div>

    <script src="{{ asset('js/chat-tracking.js') }}"></script>
</body>
</html>