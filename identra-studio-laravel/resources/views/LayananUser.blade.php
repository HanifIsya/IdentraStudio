<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan - Identra Studio</title>
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
        .nav-link.active { background: rgba(168, 85, 247, 0.15); color: white; }
        .main { flex: 1; margin-left: 220px; padding: 32px 36px; }
        .card-service { border-radius: 24px; padding: 24px; display: flex; flex-direction: column; transition: 0.3s; height: 100%; border: 1px solid rgba(255,255,255,0.1); }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="font-black text-2xl mb-10 leading-tight">IDENTRA<br>STUDIO.</div>
        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}" class="nav-link"><i class="fa-solid fa-table-columns"></i><span>Dashboard</span></a>
            <a href="{{ route('layanan.index') }}" class="nav-link active"><i class="fa-solid fa-layer-group"></i><span>Layanan</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-credit-card"></i><span>Transaction</span></a>
            <a href="{{ route('project.tracking') }}" class="nav-link"><i class="fa-solid fa-location-dot"></i><span>Tracking</span></a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" class="mt-auto">
            @csrf
            <button type="submit" class="nav-link w-full text-left bg-transparent border-none cursor-pointer">
                <i class="fa-solid fa-right-from-bracket"></i><span>Logout</span>
            </button>
        </form>
    </aside>

    <main class="main">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-black">Hello {{ explode(' ', auth()->user()->Nama)[0] }} !</h1>
                <p class="text-6xl font-black mt-2">Layanan</p>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="/cart" class="relative w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center border border-white/20 hover:bg-white/20 transition-all">
                    <i class="fa-solid fa-cart-shopping text-purple-400 text-lg"></i>
                    <span id="cart-badge" class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full hidden">0</span>
                </a>
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center border border-white/20">
                    <i class="fa-solid fa-bell text-yellow-400"></i>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($layanans as $layanan)
            <div class="group card-service bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-[24px] transition-all duration-300 hover:bg-white hover:text-black hover:scale-[1.02] flex flex-col justify-between h-full">
                <div>
                    <div class="flex items-center gap-4 mb-6">
                        <i class="fa-solid {{ $layanan->ikon }} text-3xl text-white group-hover:text-purple-600 transition-colors"></i>
                        <div>
                            <h3 class="font-bold text-lg leading-tight">{{ $layanan->nama_layanan }}</h3>
                            <p class="text-[10px] opacity-60 group-hover:text-gray-600">{{ $layanan->tagline }}</p>
                        </div>
                    </div>

                    <ul class="space-y-3 mb-8">
                        @foreach($layanan->fitur as $fitur)
                        <li class="flex items-center gap-3 text-xs">
                            <i class="fa-solid fa-check text-purple-400 group-hover:text-blue-600"></i>
                            <span class="group-hover:text-gray-800">{{ $fitur }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="flex justify-between items-center mt-auto pt-4 border-t border-white/10 group-hover:border-black/10">
                    <button 
                        class="btn-add-cart bg-purple-600 text-white text-xs px-4 py-2 rounded-xl font-bold hover:bg-purple-700 transition-all"
                        data-id="{{ $layanan->Layanan_ID }}"
                        data-nama="{{ $layanan->nama_layanan }}"
                        data-harga="{{ $layanan->harga }}">
                        Pilih Jasa
                    </button>
                    
                    <span class="bg-purple-600/20 text-purple-400 group-hover:bg-purple-600 group-hover:text-white px-4 py-1 rounded-full text-sm font-bold transition-all">
                        Rp {{ number_format((float)$layanan->harga, 0, ',', '.') }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <script src="{{ asset('js/layanan.js') }}"></script>
</body>
</html>