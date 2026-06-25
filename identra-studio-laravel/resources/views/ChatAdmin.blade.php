<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat Support Admin - Identra Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Urbanist', sans-serif; background: linear-gradient(135deg, #1E0A2E 0%, #000000 100%); min-height: 100vh; color: white; display: flex; overflow: hidden; }
        .sidebar { width: 260px; background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(20px); border-right: 1px solid rgba(255,255,255,0.05); padding: 30px 20px; height: 100vh; display: flex; flex-direction: column; }
        .glass-card { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); backdrop-filter: blur(12px); border-radius: 24px; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 14px; color: #94A3B8; transition: 0.3s; text-decoration: none; margin-bottom: 4px; }
        .nav-link:hover, .nav-link.active { background: rgba(168, 85, 247, 0.15); color: white; }
        main { flex: 1; display: flex; height: 100vh; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="font-black text-3xl mb-12 tracking-tighter">IDENTRA<br>STUDIO.</div>
        <nav class="flex-grow">
            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-users-gear"></i><span>Manajemen User</span></a>
            <a href="{{ route('admin.layanan.index') }}" class="nav-link"><i class="fa-solid fa-boxes-packing"></i><span>Manajemen Layanan</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-file-invoice-dollar"></i><span>Transaksi</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-briefcase"></i><span>Project Client</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-folder-open"></i><span>File & Asset</span></a>
            <a href="{{ route('chat.index') }}" class="nav-link active"><i class="fa-solid fa-comments"></i><span>Chat Support</span></a>
        </nav>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link w-full text-left bg-transparent border-none cursor-pointer mt-auto">
                <i class="fa-solid fa-power-off text-red-500"></i><span>Logout</span>
            </button>
        </form>
    </aside>

    <main>
        <div class="w-80 border-r border-white/5 bg-black/20 flex flex-col">
            <div class="p-6 border-b border-white/5">
                <h2 class="text-xl font-bold">Chat Box</h2>
                <p class="text-xs text-gray-400">Pilih client untuk membalas pesan</p>
            </div>
            <div class="flex-grow overflow-y-auto p-4 space-y-2">
                @forelse($chatUsers as $cUser)
                    <button onclick="selectUser({{ $cUser->User_ID }}, '{{ $cUser->Nama }}')" 
                        id="user-btn-{{ $cUser->User_ID }}"
                        class="user-chat-link w-full text-left flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all">
                        <div class="w-10 h-10 rounded-xl bg-purple-600/30 text-purple-400 font-bold flex items-center justify-center">
                            {{ strtoupper(substr($cUser->Nama, 0, 2)) }}
                        </div>
                        <div class="flex-grow min-w-0">
                            <p class="text-sm font-bold truncate">{{ $cUser->Nama }}</p>
                            <p class="text-[11px] text-gray-400 truncate">{{ $cUser->Email }}</p>
                        </div>
                    </button>
                @empty
                    <p class="text-xs text-center text-gray-500 mt-8">Belum ada pesan masuk.</p>
                @endforelse
            </div>
        </div>

        <div class="flex-grow flex flex-col bg-black/40 relative">
            <div id="empty-chatroom" class="absolute inset-0 flex flex-col items-center justify-center text-center p-8 z-10 bg-[#0b0a14]">
                <i class="fa-solid fa-message text-4xl text-purple-500/30 mb-3"></i>
                <h3 class="text-sm font-bold text-gray-400">Pilih Ruang Obrolan</h3>
                <p class="text-xs text-gray-500 max-w-xs mt-1">Klik salah satu nama client di panel sebelah kiri untuk memulai koordinasi pengerjaan proyek.</p>
            </div>

            <div class="p-4 border-b border-white/5 bg-white/[0.01] flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-purple-600 text-white font-bold flex items-center justify-center text-xs" id="active-user-avatar">
                    ??
                </div>
                <div>
                    <h3 class="text-sm font-bold" id="active-user-name">Memuat Client...</h3>
                    <p class="text-[10px] text-purple-400">Koordinasi Project Agency</p>
                </div>
            </div>

            <div id="admin-chat-box" class="flex-grow overflow-y-auto p-6 space-y-3">
                </div>

            <div class="p-4 border-t border-white/5 bg-white/[0.01] flex gap-2">
                <input type="text" id="admin-chat-input" placeholder="Tulis balasan Anda..." 
                    class="flex-grow bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-purple-500/50">
                <button onclick="sendAdminChat()" class="bg-purple-600 hover:bg-purple-700 text-white w-12 h-11 rounded-xl flex items-center justify-center transition-all shadow-md">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </main>

    <script>
        let activeUserId = null;
        let pollingInterval = null;

        const chatBox = document.getElementById('admin-chat-box');
        const chatInput = document.getElementById('admin-chat-input');
        const emptyState = document.getElementById('empty-chatroom');

        function selectUser(userId, name) {
            activeUserId = userId;
            
            // Atur tampilan Header Chat
            document.getElementById('active-user-name').innerText = name;
            document.getElementById('active-user-avatar').innerText = name.substring(0, 2).toUpperCase();
            
            // Sembunyikan empty state pelindung awal
            emptyState.classList.add('hidden');

            // Set fokus menu aktif pada list user
            document.querySelectorAll('.user-chat-link').forEach(btn => btn.classList.remove('bg-white/10', 'border-l-4', 'border-purple-500'));
            document.getElementById('user-btn-' + userId).classList.add('bg-white/10', 'border-l-4', 'border-purple-500');

            // Jalankan penarikan data pesan
            loadAdminMessages();
            
            // Bereskan interval polling lama agar tidak tabrakan memory leak
            if (pollingInterval) clearInterval(pollingInterval);
            pollingInterval = setInterval(loadAdminMessages, 3000);
        }

        function loadAdminMessages() {
            if (!activeUserId) return;

            fetch('/api/messages/' + activeUserId)
                .then(res => res.json())
                .then(data => {
                    chatBox.innerHTML = '';
                    data.forEach(msg => {
                        // Di sisi admin, jika sender_role == 'admin', posisinya di kanan (Me)
                        // Jika sender_role == 'user', posisinya di kiri (Client)
                        const isMe = msg.sender_role === 'admin';
                        
                        chatBox.innerHTML += `
                            <div class="flex ${isMe ? 'justify-end' : 'justify-start'} mb-2">
                                <div class="${isMe ? 'bg-purple-600 text-white' : 'bg-white/10 text-white'} px-4 py-2 rounded-2xl max-w-xs text-xs shadow-sm">
                                    <p>${msg.message}</p>
                                </div>
                            </div>
                        `;
                    });
                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        }

        function sendAdminChat() {
            const text = chatInput.value.trim();
            if (!text || !activeUserId) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/api/messages', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ 
                    message: text,
                    user_id: activeUserId // Beri tahu backend pesan ini ditujukan untuk user mana
                })
            })
            .then(res => res.json())
            .then(response => {
                if (response.status === 'success') {
                    chatInput.value = '';
                    loadAdminMessages();
                }
            });
        }

        // Shortcut enter key
        chatInput.addEventListener("keyup", function(e) {
            if (e.key === "Enter") sendAdminChat();
        });
    </script>
</body>
</html>