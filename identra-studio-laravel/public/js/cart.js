document.addEventListener('DOMContentLoaded', () => {
    // 1. Ambil data dari LocalStorage
    let cart = JSON.parse(localStorage.getItem('identra_cart')) || [];
    
    // Log untuk pengecekan (Bisa dilihat di F12 -> Console)
    console.log("Isi Keranjang Identra:", cart);

    let usdRate = 0.000063; 
    let sgdRate = 0.000085; 

    //  Fetch API Kurs Mata Uang
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

    //  Kalkulator (Reduce)
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

    //  Render List (Map)
    function renderCartItems() {
        const container = document.getElementById('cart-items-container');
        if (!container) {
            console.error("Elemen 'cart-items-container' tidak ditemukan di Blade!");
            return;
        }

        if (cart.length === 0) {
            container.innerHTML = `
                <div class="text-center py-12 opacity-50">
                    <i class="fa-solid fa-folder-open text-5xl mb-4 block text-purple-400"></i>
                    <p>Keranjang belanja kosong.</p>
                </div>`;
            return;
        }

        // render menggunakan .map()
        // Pastikan item.nama dan item.harga sesuai dengan yang di push di layanan.js
        container.innerHTML = cart.map(item => `
            <div class="flex justify-between items-center bg-white/5 p-5 rounded-2xl border border-white/5 hover:border-purple-500/30 transition-all mb-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-purple-600/20 flex items-center justify-center">
                        <i class="fa-solid fa-wand-magic-sparkles text-purple-400"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-base text-white">${item.nama}</h4>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest">Identra Project</p>
                    </div>
                </div>
                <div class="flex items-center gap-8">
                    <span class="font-bold text-purple-300">Rp ${(parseInt(item.harga) || 0).toLocaleString('id-ID')}</span>
                    <button onclick="removeItem('${item.id}')" class="text-gray-500 hover:text-red-500 transition-colors p-2">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </div>
        `).join('');
    }

    //  Hapus Item (Filter)
    window.removeItem = function(id) {
        cart = cart.filter(item => item.id !== id);
        localStorage.setItem('identra_cart', JSON.stringify(cart));
        renderCartItems();
        calculateTotal();
    };

    // Jalankan Fungsi Saat Halaman Dibuka
    renderCartItems();
    calculateTotal();
});