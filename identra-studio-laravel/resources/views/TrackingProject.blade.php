<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Tracking - Identra Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 'urbanist': ['"Urbanist"', 'sans-serif'] },
                    colors: {
                        'id-purple': '#A855F7',
                        'id-purple-dark': '#1E0A2E',
                        'id-gray': '#94A3B8',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Urbanist', sans-serif; margin: 0; min-height: 100vh; display: flex; color: white;
            background: linear-gradient(to bottom, #2D0A4E 0%, #6B1FA0 20%, #B06FD8 50%, #E8C8F5 80%, #F5EEF8 100%); overflow: hidden;
        }
        .sidebar { width: 220px; min-width: 220px; display: flex; flex-direction: column; padding: 28px 20px; background: rgba(20, 5, 35, 0.55); backdrop-filter: blur(16px); border-right: 1px solid rgba(255,255,255,0.08); gap: 24px; height: 100vh; }
        .avatar-ring { width: 72px; height: 72px; border-radius: 50%; border: 3px solid #A855F7; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #1E0A2E; font-size: 28px; font-weight: 800; color: white; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 10px 14px; border-radius: 12px; text-decoration: none; font-weight: 500; font-size: 15px; color: #94A3B8; transition: all 0.2s; }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,0.08); color: white; }
        .nav-link.active { background: rgba(168, 85, 247, 0.15); color: white; }
        .main { flex: 1; padding: 32px 36px; overflow-y: auto; height: 100vh; }
        .glass { background: rgba(255, 255, 255, 0.94); border: 1px solid rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border-radius: 24px; color: #1a1a2e; }
        .project-row { display: flex; align-items: center; justify-content: space-between; padding: 14px 18px; background: rgba(0,0,0,0.04); border: 1px solid rgba(0,0,0,0.08); border-radius: 16px; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="font-black text-2xl tracking-tighter">IDENTRA<br>STUDIO.</div>

        <div class="sidebar-profile">
            <div class="avatar-ring mx-auto mb-2">
                {{ substr(auth()->user()->Nama, 0, 1) }}
            </div>
            <h4 class="text-center text-sm font-bold m-0">{{ auth()->user()->Nama }}</h4>
            <p class="text-center text-[11px] text-id-gray m-0">{{ auth()->user()->email }}</p>
        </div>

        <nav class="flex flex-col gap-1 flex-1">
            <a href="{{ route('dashboard') }}" class="nav-link"><i class="fa-solid fa-table-columns"></i><span>Dashboard</span></a>
            <a href="{{ route('layanan.index') }}" class="nav-link"><i class="fa-solid fa-layer-group"></i><span>Layanan</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-credit-card"></i><span>Transaction</span></a>
            <a href="{{ route('project.tracking') }}" class="nav-link active"><i class="fa-solid fa-location-dot"></i><span>Tracking</span></a>
        </nav>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link w-full text-left bg-transparent border-none cursor-pointer">
                <i class="fa-solid fa-right-from-bracket"></i><span>Logout</span>
            </button>
        </form>
    </aside>

    <main class="main">
        <header class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-3xl font-black">Project Tracking Workspace</h1>
                <p class="text-sm text-id-gray mt-1">Pantau perkembangan pengerjaan aplikasi Anda</p>
            </div>
        </header>

        @if(!$hasPurchased)
            <div class="glass flex flex-col items-center justify-center py-20 text-center px-6">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center text-id-purple text-2xl mb-4">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Belum Ada Project Aktif</h3>
                <p class="text-xs text-gray-500 max-w-sm mt-2">Anda belum melakukan pembelian layanan atau pembayaran Anda belum diverifikasi. Silakan pilih layanan terlebih dahulu.</p>
                <a href="{{ route('layanan.index') }}" class="mt-5 bg-id-purple text-white px-5 py-2.5 rounded-xl font-bold text-xs hover:bg-purple-600 transition-all shadow-md">Lihat Katalog Jasa</a>
            </div>
        @else
            <div style="display:grid; grid-template-columns: 1.2fr 0.8fr; gap:20px;">
                
                <div class="flex flex-col gap-5">
                    <div class="glass p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-base font-bold text-gray-800">Development Progress</h3>
                            <div class="flex items-center gap-2">
                                <div class="h-2 bg-gray-200 rounded-full w-24 overflow-hidden">
                                    <div class="h-full bg-blue-500 transition-all duration-500" style="width: {{ $progress }}%;"></div>
                                </div>
                                <span class="text-sm font-black text-gray-800">{{ $progress }}%</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3">
                            <div class="project-row">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-circle-check text-green-500 text-lg"></i>
                                    <div>
                                        <p class="text-xs font-bold text-gray-800">Requirements & Payment Settled</p>
                                        <p class="text-[10px] text-gray-400 italic">Transaksi Berhasil Terverifikasi</p>
                                    </div>
                                </div>
                            </div>

                            <div class="project-row">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid {{ $progress >= 70 ? 'fa-circle-check text-green-500' : 'fa-circle-half-stroke text-blue-500' }} text-lg"></i>
                                    <div>
                                        <p class="text-xs font-bold text-gray-800">UI/UX Slicing & Frontend</p>
                                        <p class="text-[10px] text-gray-400 italic">{{ $progress >= 70 ? 'Selesai dikerjakan' : 'Sedang dalam pengerjaan' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="project-row">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid {{ $progress == 100 ? 'fa-circle-check text-green-500' : 'fa-circle text-gray-300' }} text-lg"></i>
                                    <div>
                                        <p class="text-xs font-bold text-gray-800">Core System & Deployment</p>
                                        <p class="text-[10px] text-gray-400 italic">{{ $progress == 100 ? 'Selesai - Project Handover' : 'Menunggu tahap sebelumnya' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass p-6">
                        <h3 class="text-base font-bold text-gray-800 mb-4">Project Deliverables (ZIP/Assets)</h3>
                        <div class="project-row">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-yellow-50 rounded-xl flex items-center justify-center text-yellow-600 text-lg">
                                    <i class="fa-solid fa-file-zipper"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-800">Identra_Final_Project_Package.zip</p>
                                    <p class="text-[10px] text-gray-400 italic">Build Version Dummy Data</p>
                                </div>
                            </div>
                            <a href="#" class="text-[11px] bg-id-purple text-white px-3 py-1.5 rounded-lg font-bold hover:bg-purple-600 transition-colors">Download</a>
                        </div>
                    </div>
                </div>

                <div class="glass flex flex-col h-[450px] overflow-hidden">
                    <div class="bg-gray-100 p-4 border-b border-gray-200 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-id-purple text-white font-bold flex items-center justify-center text-xs">A</div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-800 m-0">Project Manager</h4>
                                <p class="text-[9px] text-green-600 m-0 font-semibold">Online - Workspace Chat</p>
                            </div>
                        </div>
                        @if($progress == 100)
                            <span class="bg-green-100 text-green-700 font-bold text-[9px] px-2 py-0.5 rounded-md uppercase">Completed</span>
                        @endif
                    </div>

                    <div id="chat-box" class="flex-1 p-4 overflow-y-auto space-y-3 bg-gray-50 flex flex-col"></div>

                    @if($progress < 100)
                        <form id="chat-form" class="p-3 bg-white border-t border-gray-200 flex gap-2">
                            @csrf
                            <input type="text" id="chat-input" placeholder="Diskusikan revisi/penyesuaian..." 
                                   class="flex-1 bg-gray-50 border border-gray-200 text-gray-800 text-xs rounded-xl px-4 py-2 focus:outline-none focus:border-id-purple transition-all">
                            <button type="submit" class="bg-id-purple text-white px-4 py-2 rounded-xl text-xs font-bold">Kirim</button>
                        </form>
                    @else
                        <div class="p-4 bg-gray-100 border-t border-gray-200 text-center text-xs text-gray-500 font-medium italic">
                            <i class="fa-solid fa-lock text-gray-400 mr-1"></i> Project telah selesai. Sesi chat konsultasi otomatis ditutup.
                        </div>
                    @endif
                </div>

            </div>
        @endif
    </main>

    @if($hasPurchased)
    <script>
        const chatBox = document.getElementById('chat-box');
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');

        function loadMessages() {
            fetch('/api/messages')
                .then(res => res.json())
                .then(data => {
                    chatBox.innerHTML = '';
                    if(data.length === 0) {
                        chatBox.innerHTML = `<p class="text-[11px] text-gray-400 text-center italic my-auto">Belum ada obrolan.</p>`;
                        return;
                    }
                    data.forEach(msg => {
                        const isMe = msg.sender_role === 'user';
                        const msgWrapper = document.createElement('div');
                        msgWrapper.className = `flex w-full ${isMe ? 'justify-end' : 'justify-start'}`;
                        msgWrapper.innerHTML = `
                            <div class="max-w-[80%] rounded-xl px-3 py-2 text-xs shadow-sm ${isMe ? 'bg-purple-600 text-white rounded-br-none' : 'bg-gray-200 text-gray-800 rounded-bl-none'}">
                                <p class="m-0 leading-relaxed">${msg.message}</p>
                                <span class="text-[9px] block text-right mt-1 opacity-60">${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                            </div>
                        `;
                        chatBox.appendChild(msgWrapper);
                    });
                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        }

        if(chatForm) {
            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const text = chatInput.value.trim();
                if(!text) return;

                fetch('/api/messages', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ message: text })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) { chatInput.value = ''; loadMessages(); }
                });
            });
        }

        loadMessages();
        setInterval(loadMessages, 3000);
    </script>
    @endif

</body>
</html>