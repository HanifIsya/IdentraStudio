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
                            <div class="w-7 h-7 rounded-xl bg-[#2B2B30] text-[#D4AF37] font-bold flex items-center justify-center text-[10px] flex-shrink-0 border border-white/5">IS</div>
                            <div class="chat-bubble-admin rounded-2xl px-4 py-2.5 text-xs">
                                <p class="leading-relaxed break-words">${parseChatMessageContent(msg.message, true)}</p>
                                <span class="block text-[9px] text-gray-400 mt-1 text-right font-semibold">${formatChatTime(msg.created_at)}</span>
                            </div>
                        </div>`;
                } else {
                    chatHTML += `
                        <div class="flex items-start gap-2.5 max-w-[85%] ml-auto justify-end animate-fade-in text-right">
                            <div class="chat-bubble-client rounded-2xl px-4 py-2.5 text-xs text-white">
                                <p class="leading-relaxed text-left break-words">${parseChatMessageContent(msg.message, false)}</p>
                                <span class="block text-[9px] text-slate-400 mt-1 font-semibold">${formatChatTime(msg.created_at)}</span>
                            </div>
                        </div>`;
                }
            });

            // Hitung tinggi scroll sebelum memasukkan HTML baru
            const isAtBottom = chatBox.scrollTop + chatBox.clientHeight >= chatBox.scrollHeight - 120;

            chatBox.innerHTML = chatHTML;

            // Jika user sedang berada di bawah, paksa scrollbar otomatis turun
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
    if (!input || !input.value.trim() || !currentActiveRoomId) return;

    const formData = new FormData();
    formData.append('transaction_id', currentActiveRoomId);
    formData.append('message', input.value.trim());

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

/**
 * Pembantu format konten deteksi file upload dengan kontras warna baru
 */
function parseChatMessageContent(content, isAdmin) {
    if (content.startsWith('uploads/')) {
        const fileName = content.split('/').pop();
        // Berikan warna tautan yang kontras sesuai dengan warna latar belakang gelembung chat masing-masing
        const linkClass = isAdmin ? 'text-blue-600 hover:text-blue-800' : 'text-[#F3E5AB] hover:text-white';
        return `<a href="/storage/${content}" target="_blank" class="${linkClass} font-bold flex items-center gap-1.5 underline"><i class="fa-solid fa-file-arrow-down"></i> Lampiran Berkas (${fileName.substring(0,14)}...)</a>`;
    }
    return content;
}

/**
 * Pembantu format waktu jam menit
 */
function formatChatTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + " WIB";
}

/**
 * Dukungan tombol ENTER untuk mengirim pesan
 */
document.addEventListener('DOMContentLoaded', () => {
    const inputEl = document.getElementById('chat-input');
    if(inputEl) {
        inputEl.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendChat();
        });
    }
});