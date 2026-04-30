<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Layanan - Identra Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Urbanist', sans-serif; background: linear-gradient(135deg, #1E0A2E 0%, #000000 100%); min-height: 100vh; color: white; display: flex; overflow: hidden; }
        .sidebar { width: 260px; background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(20px); border-right: 1px solid rgba(255,255,255,0.05); padding: 30px 20px; height: 100vh; display: flex; flex-direction: column; }
        .glass-card { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); backdrop-filter: blur(12px); border-radius: 24px; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 14px; color: #94A3B8; transition: 0.3s; text-decoration: none; margin-bottom: 4px; }
        .nav-link:hover, .nav-link.active { background: rgba(168, 85, 247, 0.15); color: white; }
        main { flex: 1; padding: 40px; overflow-y: auto; height: 100vh; }
    </style>
</head>
<body>

    <!-- SIDEBAR (Tersambung Navigasinya) -->
    <aside class="sidebar">
        <div class="font-black text-3xl mb-12 tracking-tighter">IDENTRA<br>STUDIO.</div>
        <nav class="flex-grow">
            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-users-gear"></i><span>Manajemen User</span></a>
            <a href="{{ route('admin.layanan.index') }}" class="nav-link active"><i class="fa-solid fa-boxes-packing"></i><span>Manajemen Layanan</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-file-invoice-dollar"></i><span>Transaksi</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-briefcase"></i><span>Project Client</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-folder-open"></i><span>File & Assent</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-comments"></i><span>Chat Support</span></a>
        </nav>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link w-full text-left bg-transparent border-none cursor-pointer mt-auto">
                <i class="fa-solid fa-power-off text-red-500"></i><span>Logout</span>
            </button>
        </form>
    </aside>

    <main>
        <!-- Header -->
        <header class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-4xl font-black">Hello Admin !</h1>
                <h2 class="text-2xl font-bold opacity-80">Manajemen Layanan</h2>
                <p class="text-xs text-id-gray opacity-50 mt-2">Dashboard > <span class="text-id-purple">Manajemen Layanan</span></p>
            </div>
            <div class="w-12 h-12 rounded-2xl glass-card flex items-center justify-center">
                <i class="fa-solid fa-bell text-yellow-400"></i>
            </div>
        </header>

        <!-- Stats Cards (Sesuai Figma) -->
        <div class="grid grid-cols-4 gap-4 mb-8">
            <div class="glass-card p-4 flex items-center gap-4">
                <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-xl"><i class="fa-solid fa-boxes-stacked"></i></div>
                <div><p class="text-[10px] opacity-50">Total Layanan</p><p class="font-bold text-lg">{{ $total }}</p></div>
            </div>
            <div class="glass-card p-4 flex items-center gap-4">
                <div class="w-12 h-12 bg-green-500/10 text-green-500 rounded-xl flex items-center justify-center text-xl"><i class="fa-solid fa-check-double"></i></div>
                <div><p class="text-[10px] opacity-50">Aktif</p><p class="font-bold text-lg">{{ $total }}</p></div>
            </div>
            <div class="glass-card p-4 flex items-center gap-4 text-orange-400">
                <div class="w-12 h-12 bg-orange-500/10 rounded-xl flex items-center justify-center text-xl"><i class="fa-solid fa-pause"></i></div>
                <div><p class="text-[10px] opacity-50 text-white">Nonaktif</p><p class="font-bold text-lg text-white">0</p></div>
            </div>
            <!-- Tombol Tambah Layanan -->
            <a href="{{ route('admin.layanan.create') }}" class="bg-purple-600 hover:bg-purple-700 transition-all rounded-[20px] font-bold text-sm px-6 py-3">
    + Tambah Layanan
</a>
        </div>

        <!-- Tabel Layanan -->
        <div class="glass-card overflow-hidden bg-white">
            <div class="p-6 flex justify-between items-center text-black">
                <h3 class="font-bold text-xl">Daftar Layanan</h3>
                <div class="flex gap-2">
                    <select class="bg-gray-100 border-none rounded-lg text-xs px-3 py-2"><option>Semua Kategori</option></select>
                    <input type="text" placeholder="Cari Layanan.." class="bg-gray-100 border-none rounded-lg text-xs px-4 py-2 w-64">
                </div>
            </div>
            <table class="w-full text-left text-black">
                <thead class="bg-gray-50 text-[11px] font-bold uppercase opacity-60">
                    <tr>
                        <th class="px-6 py-4">Layanan</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    @foreach($layanans as $layanan)
                    <tr class="border-b border-gray-100">
                        <td class="px-6 py-4 flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center text-white"><i class="fa-solid {{ $layanan->ikon }}"></i></div>
                            <div><p class="font-bold text-sm">{{ $layanan->nama_layanan }}</p><p class="opacity-50">Design</p></div>
                        </td>
                        <td class="px-6 py-4">Design</td>
                        <td class="px-6 py-4 max-w-xs truncate">{{ $layanan->tagline }}</td>
                        <td class="px-6 py-4 font-bold">Rp {{ number_format(str_replace('$', '', $layanan->harga) * 15000, 0, ',', '.') }}</td>
                        <td class="px-6 py-4"><span class="bg-green-100 text-green-600 px-2 py-1 rounded-md font-bold">Aktif</span></td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('admin.layanan.edit', $layanan->Layanan_ID) }}" class="bg-purple-100 text-purple-600 p-2 rounded-lg inline-block">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
                            <form action="{{ route('admin.layanan.destroy', $layanan->Layanan_ID) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-100 text-red-600 p-2 rounded-lg" onclick="return confirm('Hapus layanan ini?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>