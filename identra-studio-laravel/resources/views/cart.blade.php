<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Identra Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 'urbanist': ['"Urbanist"', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Urbanist', sans-serif;
            background: linear-gradient(to bottom, #2D0A4E 0%, #000000 100%);
            min-height: 100vh;
            color: white;
            display: flex;
        }
        .sidebar { width: 220px; background: rgba(20, 5, 35, 0.55); backdrop-filter: blur(16px); border-right: 1px solid rgba(255,255,255,0.08); padding: 28px 20px; height: 100vh; position: fixed; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 10px 14px; border-radius: 12px; color: #94A3B8; transition: 0.2s; text-decoration: none; }
        .main { flex: 1; margin-left: 220px; padding: 32px 36px; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="font-black text-2xl mb-10 leading-tight">IDENTRA<br>STUDIO.</div>
        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}" class="nav-link"><i class="fa-solid fa-table-columns"></i><span>Dashboard</span></a>
            <a href="{{ route('layanan.index') }}" class="nav-link active"><i class="fa-solid fa-layer-group"></i><span>Layanan</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-credit-card"></i><span>Transaction</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-location-dot"></i><span>Tracking</span></a>
        </nav>
    </aside>

    <main class="main">
        <header class="mb-10">
            <a href="{{ route('layanan.index') }}" class="text-sm text-purple-400 hover:underline"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali ke Katalog</a>
            <h1 class="text-5xl font-black mt-4">Review Project Cart</h1>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-[24px]">
                    <h2 class="text-xl font-bold mb-4 border-b border-white/10 pb-2">Jasa yang Anda Pilih</h2>
                    <div id="cart-items-container" class="space-y-4">
                        </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-[24px]">
                    <h2 class="text-xl font-bold mb-4 border-b border-white/10 pb-2">Ringkasan Biaya</h2>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between opacity-70">
                            <span>Estimasi Waktu</span>
                            <span>Akan didiskusikan</span>
                        </div>
                        <hr class="border-white/10">
                        
                        <div class="pt-2">
                            <span class="text-xs text-gray-400 block">Total IDR (Rupiah)</span>
                            <div id="total-idr" class="text-3xl font-black text-purple-400">Rp 0</div>
                        </div>

                        <div class="pt-4 border-t border-white/10 bg-purple-950/30 p-4 rounded-xl space-y-3">
                            <span class="text-xs font-bold text-purple-300 uppercase tracking-wider block"><i class="fa-solid fa-globe mr-1"></i> International Currency (Live Rates)</span>
                            <div class="flex justify-between items-center">
                                <span class="text-xs opacity-80">Estimasi USD ($)</span>
                                <span id="total-usd" class="font-bold text-white text-base">Calculating...</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs opacity-80">Estimasi SGD ($)</span>
                                <span id="total-sgd" class="font-bold text-white text-base">Calculating...</span>
                            </div>
                        </div>
                    </div>

                    <button class="w-full mt-6 bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded-xl transition-all shadow-lg shadow-purple-600/20">
                        Lanjutkan Konsultasi Project
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/cart.js') }}"></script>
</body>
</html>