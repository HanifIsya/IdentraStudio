// public/js/chat-tracking.js

let chatPollInterval = null;

/**
 * Fungsi global yang dipanggil otomatis dari komponen Blade 
 * saat customer mengklik salah satu daftar Project Room di kiri.
 */
window.setChatRoomId = function(id) {
    // Bersihkan interval polling lama jika ada perpindahan room
    if (chatPollInterval) {
        clearInterval(chatPollInterval);
    }

    // Ambil history chat room yang baru secara instan
    fetchRoomMessages(id);

    // Jalankan realtime polling setiap 3 detik sekali khusus untuk room aktif ini
    chatPollInterval = setInterval(() => {
        fetchRoomMessages(id);
    }, 3000);
};

/**
 * Ambil data riwayat pesan dari server berdasarkan ID Proyek aktif
 */
function fetchRoomMessages(transactionId) {
    if (!transactionId) return;

    fetch('/api/messages/' + transactionId)
        .then(res => res.json())
        .then(messages => {
            const chatBox = document.getElementById('chat-box');
            if (!chatBox) return;

            let chatHTML = '';

            messages.forEach(msg => {
                // Jika sender_role adalah admin, maka balon chat ditaruh di KIRI (Lawan bicara)
                // Jika sender_role adalah user, maka balon chat ditaruh di KANAN (Diri sendiri)
                if (msg.sender_role === 'admin') {
                    chatHTML += `
                        <div class="flex items-start gap-2.5 max-w-[85%] animate-fade-in text-left">
                            <div class="w-7 h-7 rounded-full bg-purple-600/30 text-purple-400 font-bold flex items-center justify-center text-[10px] flex-shrink-0">IS</div>
                            <div class="bg-white/5 border border-white/10 rounded-2xl px-4 py-2.5 text-xs text-gray-200 shadow">
                                <p class="leading-relaxed break-all">${parseChatMessageContent(msg.message)}</p>
                                <span class="block text-[9px] text-gray-500 mt-1 text-right">${formatChatTime(msg.created_at)}</span>
                            </div>
                        </div>`;
                } else {
                    chatHTML += `
                        <div class="flex items-start gap-2.5 max-w-[85%] ml-auto justify-end animate-fade-in text-right">
                            <div class="bg-purple-600 border border-purple-500/20 rounded-2xl px-4 py-2.5 text-xs text-white shadow-md">
                                <p class="leading-relaxed text-left break-all">${parseChatMessageContent(msg.message)}</p>
                                <span class="block text-[9px] text-purple-300 mt-1">${formatChatTime(msg.created_at)}</span>
                            </div>
                        </div>`;
                }
            });

            // Ganti isi chat box dan paksa scrollbar otomatis turun ke bawah
            const currentScroll = chatBox.scrollTop + chatBox.clientHeight;
            const isAtBottom = currentScroll >= chatBox.scrollHeight - 100;

            chatBox.innerHTML = chatHTML;

            if (isAtBottom || chatBox.innerHTML === chatHTML) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        })
        .catch(err => console.error('Gagal memuat pesan:', err));
}

/**
 * Mengirim pesan teks baru milik Customer ke server
 */
function sendChat() {
    const input = document.getElementById('chat-input');
    // Variabel kunci 'currentActiveRoomId' diambil dari scope global TrackingProject.blade.php
    if (!input || !input.value.trim() || !currentActiveRoomId) return;

    const formData = new FormData();
    formData.append('transaction_id', currentActiveRoomId);
    formData.append('message', input.value.trim());

    // Nonaktifkan tombol kirim sementara agar tidak double click
    const sendBtn = document.getElementById('btn-send-chat');
    if(sendBtn) sendBtn.disabled = true;

    fetch('/api/messages', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if (res.status === 'success') {
            input.value = '';
            fetchRoomMessages(currentActiveRoomId);
        }
    })
    .finally(() => {
        if(sendBtn) sendBtn.disabled = false;
    });
}

/**
 * Mengirim berkas file biner (attachment) dari chat customer
 */
function sendFile() {
    const fileInput = document.getElementById('chat-file');
    if (!fileInput || fileInput.files.length === 0 || !currentActiveRoomId) return;

    const formData = new FormData();
    formData.append('transaction_id', currentActiveRoomId);
    formData.append('file', fileInput.files[0]);

    fetch('/api/messages', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if (res.status === 'success') {
            fileInput.value = '';
            fetchRoomMessages(currentActiveRoomId);
        }
    });
}

// Pembantu format konten deteksi file upload
function parseChatMessageContent(content) {
    if (content.startsWith('uploads/')) {
        const fileName = content.split('/').pop();
        return `<a href="/storage/${content}" target="_blank" class="text-purple-300 hover:underline font-bold flex items-center gap-1"><i class="fa-solid fa-file-arrow-down"></i> Lampiran Berkas (${fileName.substring(0,10)}...)</a>`;
    }
    return content;
}

// Pembantu format waktu jam menit
function formatChatTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + " WIB";
}

// Dukungan tombol ENTER untuk mengirim pesan
document.addEventListener('DOMContentLoaded', () => {
    const inputEl = document.getElementById('chat-input');
    if(inputEl) {
        inputEl.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendChat();
        });
    }
});