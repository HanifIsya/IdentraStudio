/**
 * Identra Studio - Tracking Project Chat Support System
 * Mengatur jalannya API Polling & Aksi Kirim Pesan secara Real-time
 */

document.addEventListener("DOMContentLoaded", function () {
    const chatBox = document.getElementById('chat-box');
    const chatInput = document.getElementById('chat-input');

    // Validasi pengaman jika elemen tidak ditemukan di halaman
    if (!chatBox || !chatInput) return;

    // 1. Ambil History Chat dari Database (Polling API)
    function loadMessages() {
        fetch('/api/messages')
            .then(res => res.json())
            .then(data => {
                chatBox.innerHTML = ''; // Kosongkan chatbox lama
                
                data.forEach(msg => {
                    // Jika sender_role == 'user' -> Pesan Anda (Kanan)
                    // Jika sender_role == 'admin' -> Balasan Admin (Kiri)
                    const isMe = msg.sender_role === 'user';
                    
                    chatBox.innerHTML += `
                        <div class="flex ${isMe ? 'justify-end' : 'justify-start'} mb-2">
                            <div class="${isMe ? 'bg-purple-600 text-white' : 'bg-white/10 text-white'} px-4 py-2 rounded-2xl max-w-xs text-xs shadow-sm">
                                <p>${msg.message}</p>
                            </div>
                        </div>
                    `;
                });
                
                // Dorong scroll ke posisi paling bawah otomatis
                chatBox.scrollTop = chatBox.scrollHeight;
            })
            .catch(err => console.error("Error fetching messages:", err));
    }

    // Eksekusi saat pertama kali halaman terbuka
    loadMessages();
    
    // Sinkronisasi ulang otomatis setiap 3 detik
    setInterval(loadMessages, 3000);

    // 2. Kirim Chat Baru ke Admin
    window.sendChat = function() {
        const messageText = chatInput.value.trim();
        if (!messageText) return;

        // Mengambil CSRF token langsung dari meta tag di head HTML
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch('/api/messages', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ message: messageText })
        })
        .then(res => res.json())
        .then(response => {
            if (response.status === 'success') {
                chatInput.value = ''; // Reset form input teks
                loadMessages(); // Refresh tampilan bubble chat
            }
        })
        .catch(err => console.error("Error sending message:", err));
    };

    // Pintasan keyboard: Tekan Enter untuk kirim chat
    chatInput.addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            sendChat();
        }
    });
});