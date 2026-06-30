// public/js/chat-admin.js

let adminChatPollInterval = null;

/**
 * Ditangkap otomatis dari fungsi selectProjectRoom() di chatadmin.blade.php
 */
window.setAdminActiveRoom = function(id) {
    if (adminChatPollInterval) {
        clearInterval(adminChatPollInterval);
    }

    loadAdminRoomMessages(id);

    // Polling otomatis admin jalan tiap 3 detik
    adminChatPollInterval = setInterval(() => {
        loadAdminRoomMessages(id);
    }, 3000);
};

/**
 * Memuat percakapan khusus room proyek tertentu dari database
 */
function loadAdminRoomMessages(transactionId) {
    if (!transactionId) return;

    fetch('/api/messages/' + transactionId)
        .then(res => res.json())
        .then(messages => {
            const adminChatBox = document.getElementById('admin-chat-box');
            if (!adminChatBox) return;

            let chatHTML = '';

            messages.forEach(msg => {
                // Di mata Admin: 
                // Jika dikirim oleh 'admin', balon berada di KANAN (Diri admin sendiri -> Tema Gelap Studio)
                // Jika dikirim oleh 'user', balon berada di KIRI (Customer -> Tema Putih Kontras)
                if (msg.sender_role === 'admin') {
                    chatHTML += `
                        <div class="flex items-start gap-2.5 max-w-[85%] ml-auto justify-end text-right animate-fade-in">
                            <div class="chat-bubble-client rounded-2xl px-4 py-2.5 text-xs text-white">
                                <p class="leading-relaxed text-left break-words">${parseAdminFileContent(msg.message, false)}</p>
                                <span class="block text-[9px] text-slate-400 mt-1 font-semibold">${formatAdminTime(msg.created_at)}</span>
                            </div>
                        </div>`;
                } else {
                    chatHTML += `
                        <div class="flex items-start gap-2.5 max-w-[85%] text-left animate-fade-in">
                            <div class="w-8 h-8 rounded-xl bg-[#2B2B30] text-[#D4AF37] font-bold flex items-center justify-center text-xs flex-shrink-0 border border-white/5">CL</div>
                            <div class="chat-bubble-admin rounded-2xl px-4 py-2.5 text-xs">
                                <p class="leading-relaxed break-words">${parseAdminFileContent(msg.message, true)}</p>
                                <span class="block text-[9px] text-gray-400 mt-1 text-right font-semibold">${formatAdminTime(msg.created_at)}</span>
                            </div>
                        </div>`;
                }
            });

            // Hitung tinggi scroll sebelum menyuntikkan HTML baru
            const isAtBottom = adminChatBox.scrollTop + adminChatBox.clientHeight >= adminChatBox.scrollHeight - 120;

            adminChatBox.innerHTML = chatHTML;

            // Auto gulung ke bawah jika posisi scroll di area bawah
            if (isAtBottom || adminChatBox.innerHTML === chatHTML) {
                adminChatBox.scrollTop = adminChatBox.scrollHeight;
            }
        });
}

/**
 * Mengirim balasan teks Admin terikat pada room ID Proyek
 */
function sendAdminChat() {
    const input = document.getElementById('admin-chat-input');
    if (!input || !input.value.trim() || !currentActiveTransactionId) return;

    const formData = new FormData();
    formData.append('transaction_id', currentActiveTransactionId);
    formData.append('message', input.value.trim());

    fetch('/api/messages', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if(res.status === 'success') {
            input.value = '';
            loadAdminRoomMessages(currentActiveTransactionId);
        }
    });
}

/**
 * Mengubah rute berkas string path menjadi tautan download yang kontras
 */
function parseAdminFileContent(content, isClientSender) {
    if (content.startsWith('uploads/')) {
        const fileName = content.split('/').pop();
        // Berikan warna tautan yang kontras dengan latar balon chat-nya
        const linkClass = isClientSender ? 'text-blue-600 hover:text-blue-800' : 'text-[#F3E5AB] hover:text-white';
        return `<a href="/storage/${content}" target="_blank" class="${linkClass} font-bold flex items-center gap-1.5 underline"><i class="fa-solid fa-cloud-arrow-down"></i> Lampiran Berkas (${fileName.substring(0,14)}...)</a>`;
    }
    return content;
}

/**
 * Format jam dan menit
 */
function formatAdminTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + " WIB";
}

// Listener tombol enter admin workspace
document.addEventListener('DOMContentLoaded', () => {
    const adminInput = document.getElementById('admin-chat-input');
    if(adminInput) {
        adminInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendAdminChat();
        });
    }
});