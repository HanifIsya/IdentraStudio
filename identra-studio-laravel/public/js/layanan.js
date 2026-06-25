document.addEventListener('DOMContentLoaded', () => {
    let cart = JSON.parse(localStorage.getItem('identra_cart')) || [];
    updateCartBadge();

    // Handle klik tombol "Pilih Jasa"
    document.querySelectorAll('.btn-add-cart').forEach(button => {
        button.addEventListener('click', (e) => {
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const harga = parseFloat(button.getAttribute('data-harga'));

            // Cek apakah item sudah ada di cart agar tidak duplikat
            const isExist = cart.some(item => item.id === id);
            if (!isExist) {
                cart.push({ id, nama, harga });
                localStorage.setItem('identra_cart', JSON.stringify(cart));
                updateCartBadge();
                alert(`${nama} berhasil ditambahkan ke keranjang belanja!`);
            } else {
                alert('Jasa ini sudah ada di keranjang belanja Anda.');
            }
        });
    });

    function updateCartBadge() {
        const badge = document.getElementById('cart-badge');
        if (badge) {
            if(cart.length > 0) {
                badge.innerText = cart.length;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }
    }
});