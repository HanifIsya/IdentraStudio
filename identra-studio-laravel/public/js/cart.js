// public/js/cart.js

document.addEventListener('DOMContentLoaded', () => {
    // 1. Ambil data dari LocalStorage
    let cart = JSON.parse(localStorage.getItem('identra_cart')) || [];
    
    // Log untuk pengecekan (Bisa dilihat di F12 -> Console)
    console.log("Isi Keranjang Identra:", cart);

    let usdRate = 0.000063; 
    let sgdRate = 0.000085; 

    // Fetch API Kurs Mata Uang Live
    fetch('https://api.frankfurter.app/latest?from=IDR&to=USD,SGD')
        .then(response => response.json())
        .then(data => {
            if(data && data.rates) {
                usdRate = data.rates.USD;
                sgdRate = data.rates.SGD;
                console.log("Kurs Berhasil di-Update secara Live!");
            }
            calculateTotal();
        })
        .catch(err => {
            console.warn("Gagal Fetch API, Menggunakan Kurs Standar.");
            calculateTotal();
        });

    // Kalkulator Total Ringkasan Biaya (Reduce)
    function calculateTotal() {
        const totalIDR = cart.reduce((sum, item) => sum + (parseInt(item.harga) || 0), 0);
        const totalUSD = totalIDR * usdRate;
        const totalSGD = totalIDR * sgdRate;

        const elTotalIdr = document.getElementById('total-idr');
        if(elTotalIdr) {
            elTotalIdr.innerText = 'Rp ' + totalIDR.toLocaleString('id-ID');
            document.getElementById('total-usd').innerText = '$ ' + totalUSD.toLocaleString('en-US', { minimumFractionDigits: 2 });
            document.getElementById('total-sgd').innerText = '$ ' + totalSGD.toLocaleString('en-US', { minimumFractionDigits: 2 });
        }
    }

    // Render List Keranjang Belanja (Map) - MENYESUAIKAN LIGHT MODE BARU
    function renderCartItems() {
        const container = document.getElementById('cart-items-container');
        if (!container) {
            console.error("Elemen 'cart-items-container' tidak ditemukan di Blade!");
            return;
        }

        if (cart.length === 0) {
            container.innerHTML = `
                <div class="text-center py-12 text-slate-400">
                    <i class="fa-solid fa-folder-open text-4xl mb-3 block text-slate-300"></i>
                    <p class="text-xs font-medium">Keranjang belanja Anda kosong.</p>
                </div>`;
            return;
        }

        // Render menggunakan .map() dengan kontras Light Mode Premium
        container.innerHTML = cart.map(item => `
            <div class="flex justify-between items-center bg-white p-4 rounded-xl border border-slate-200 hover:border-id-gold/30 transition-all shadow-sm">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 bg-slate-50 border border-slate-200 text-[#2B2B30] rounded-lg flex items-center justify-center text-sm flex-shrink-0">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-[#2B2B30] truncate max-w-[180px] md:max-w-[240px]">${item.nama}</h4>
                        <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider mt-0.5">Verified Studio Pack</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 flex-shrink-0">
                    <span class="text-xs font-black text-slate-800 font-mono-atkinson">Rp ${(parseInt(item.harga) || 0).toLocaleString('id-ID')}</span>
                    <button onclick="removeItem('${item.id}')" class="text-slate-400 hover:text-red-500 transition-colors p-2 cursor-pointer">
                        <i class="fa-solid fa-trash-can text-xs"></i>
                    </button>
                </div>
            </div>
        `).join('');
    }

    // Hapus Item dari Keranjang Belanja (Filter)
    window.removeItem = function(id) {
        cart = cart.filter(item => item.id !== id);
        localStorage.setItem('identra_cart', JSON.stringify(cart));
        renderCartItems();
        calculateTotal();
    };

    // Jalankan Fungsi Inisialisasi Awal Saat Halaman Dibuka
    renderCartItems();
    calculateTotal();

    // Logika Pengiriman Pembayaran Token Snap / Invoice
    const payButton = document.getElementById('pay-button');

    if (payButton) {
        payButton.addEventListener('click', function () {
            // VALIDASI 1: Cek apakah keranjang kosong
            if (cart.length === 0) {
                alert('Keranjang Anda kosong!');
                return;
            }

            // VALIDASI 2: Batasi pengerjaan agar maksimal 1 layanan per transaksi
            if (cart.length > 1) {
                alert('Demi koordinasi proyek yang optimal, Anda hanya dapat memproses 1 jenis layanan dalam 1 transaksi. Silakan hapus salah satu layanan terlebih dahulu.');
                return;
            }

            const totalIDR = cart.reduce((sum, item) => sum + (parseInt(item.harga) || 0), 0);
            if (totalIDR <= 0) {
                alert('Total nilai transaksi tidak valid.');
                return;
            }

            // Ambil layanan_id asli dari item pertama di keranjang belanja
            const targetLayananId = cart[0].layanan_id || cart[0].id;

            // Kunci tombol aksi dan tampilkan loading statis
            payButton.innerText = 'PROCESSING...';
            payButton.disabled = true;

            // Kirim request ke backend Laravel menggunakan Fetch API
            fetch(window.location.origin + '/payment/snap-token', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ 
                    amount: totalIDR,
                    layanan_id: targetLayananId 
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.invoice_url) {
                    // Bersihkan keranjang belanja karena transaksi sukses dibuat
                    localStorage.removeItem('identra_cart');
                    
                    // Alihkan user langsung ke halaman pembayaran resmi
                    window.location.href = data.invoice_url;
                } else {
                    alert('Gagal mendapatkan invoice pembayaran: ' + (data.error || 'Unknown Error'));
                    payButton.innerText = 'BAYAR SEKARANG (SANDBOX)';
                    payButton.disabled = false;
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert('Terjadi kesalahan sistem saat menghubungi server.');
                payButton.innerText = 'BAYAR SEKARANG (SANDBOX)';
                payButton.disabled = false;
            });
        });
    }
});