// public/js/chat-admin.js

let adminChatPollInterval = null;

/**
 * Ditangkap otomatis dari fungsi selectProjectRoom() di ChatAdmin.blade.php
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
                // Jika dikirim oleh 'admin', balon berada di KANAN (Diri admin sendiri)
                // Jika dikirim oleh 'user', balon berada di KIRI (Customer)
                if (msg.sender_role === 'admin') {
                    chatHTML += `
                        <div class="flex items-start gap-2.5 max-w-[85%] ml-auto justify-end text-right">
                            <div class="bg-purple-600 border border-purple-500/20 rounded-2xl px-4 py-2.5 text-xs text-white shadow-md">
                                <p class="leading-relaxed text-left break-all">${parseAdminFileContent(msg.message)}</p>
                                <span class="block text-[9px] text-purple-300 mt-1">${formatAdminTime(msg.created_at)}</span>
                            </div>
                        </div>`;
                } else {
                    chatHTML += `
                        <div class="flex items-start gap-2.5 max-w-[85%] text-left">
                            <div class="w-8 h-8 rounded-xl bg-purple-600/20 text-purple-400 font-bold flex items-center justify-center text-xs flex-shrink-0">CL</div>
                            <div class="bg-white/5 border border-white/10 rounded-2xl px-4 py-2.5 text-xs text-gray-200 shadow">
                                <p class="leading-relaxed break-all">${parseAdminFileContent(msg.message)}</p>
                                <span class="block text-[9px] text-gray-500 mt-1 text-right">${formatAdminTime(msg.created_at)}</span>
                            </div>
                        </div>`;
                }
            });

            adminChatBox.innerHTML = chatHTML;
            adminChatBox.scrollTop = adminChatBox.scrollHeight; // Auto gulung ke bawah
        });
}

/**
 * Mengirim balasan teks Admin terikat pada room ID Proyek
 */
function sendAdminChat() {
    const input = document.getElementById('admin-chat-input');
    // Menembak variabel penampung global 'currentActiveTransactionId' milik view
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

function parseAdminFileContent(content) {
    if (content.startsWith('uploads/')) {
        return `<a href="/storage/${content}" target="_blank" class="text-purple-300 hover:underline font-bold flex items-center gap-1"><i class="fa-solid fa-cloud-arrow-down"></i> Berkas Lampiran Kiriman Client</a>`;
    }
    return content;
}

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