<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mode == 'tambah' ? 'Tambah' : 'Edit' }} Layanan - Identra Admin</title>
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
        
        /* Form Styling */
        input, textarea, select { background: #f9fafb !important; border: 1px solid #e5e7eb !important; color: #111827 !important; transition: all 0.2s; }
        input:focus, textarea:focus { border-color: #A855F7 !important; outline: none !important; ring: 2px !important; ring-color: #A855F7 !important; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="font-black text-3xl mb-12 tracking-tighter">IDENTRA<br>STUDIO.</div>
        <nav class="flex-grow">
            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-users-gear"></i><span>Manajemen User</span></a>
            <a href="{{ route('admin.layanan.index') }}" class="nav-link active"><i class="fa-solid fa-boxes-packing"></i><span>Manajemen Layanan</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-file-invoice-dollar"></i><span>Transaksi</span></a>
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
                <h2 class="text-2xl font-bold opacity-80">{{ $mode == 'tambah' ? 'Tambah Layanan Baru' : 'Edit Layanan' }}</h2>
                <p class="text-xs text-id-gray opacity-50 mt-2">Dashboard > Manajemen Layanan > <span class="text-id-purple">Form</span></p>
            </div>
        </header>

        <!-- Formulir -->
        <div class="max-w-3xl">
            <div class="bg-white rounded-[32px] p-10 text-black shadow-2xl">
                
                <form action="{{ $mode == 'tambah' ? route('admin.layanan.store') : route('admin.layanan.update', $layanan->Layanan_ID) }}" method="POST">
                    @csrf
                    @if($mode == 'edit')
                        @method('PUT')
                    @endif

                    <!-- Tempat Menampilkan Pesan Error Validasi -->
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-600 px-5 py-4 rounded-xl mb-8">
                            <div class="flex items-center gap-2 mb-2 font-bold">
                                <i class="fa-solid fa-circle-exclamation"></i> Terdapat kesalahan pengisian:
                            </div>
                            <ul class="list-disc pl-6 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Layanan -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Layanan</label>
                            <input type="text" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}" 
                                   class="w-full px-4 py-3 rounded-xl" placeholder="Contoh: Website Design" required>
                        </div>

                        <!-- Tagline -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tagline (Deskripsi Singkat)</label>
                            <input type="text" name="tagline" value="{{ old('tagline', $layanan->tagline) }}" 
                                   class="w-full px-4 py-3 rounded-xl" placeholder="Contoh: Jasa pembuatan website profesional" required>
                        </div>

                        <!-- Ikon -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Ikon FontAwesome</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <i class="fa-solid fa-icons"></i>
                                </span>
                                <input type="text" name="ikon" value="{{ old('ikon', $layanan->ikon) }}" 
                                       class="w-full pl-11 pr-4 py-3 rounded-xl" placeholder="fa-desktop" required>
                            </div>
                        </div>

                        <!-- Harga -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Harga</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 font-bold">
                                    Rp
                                </span>
                         
                                <input type="number" name="harga" value="{{ old('harga', $layanan->harga) }}" 
       class="w-full pl-11 pr-4 py-3 rounded-xl bg-white text-black" placeholder="Contoh: 2500000" required>
                            </div>
                        </div>

                        <!-- Fitur -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fitur Unggulan (Pisahkan dengan koma)</label>
                            <!-- Pada textarea, usahakan tidak ada enter ekstra di dalam tag agar tampilannya rapi -->
                            <textarea name="fitur_input" rows="4" class="w-full px-4 py-3 rounded-xl" 
                                      placeholder="Contoh: Desain Responsive, SEO Friendly, Hosting Gratis 1 Tahun">{{ old('fitur_input', $layanan->fitur ? implode(', ', $layanan->fitur) : '') }}</textarea>
                            <p class="text-[10px] text-gray-400 mt-2 italic">*Ketik fitur-fitur layanan dan pisahkan setiap fitur menggunakan tanda koma (,)</p>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-10 flex items-center gap-4 border-t border-gray-100 pt-6">
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-10 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-purple-200">
                            <i class="fa-solid fa-save mr-2"></i> {{ $mode == 'tambah' ? 'Simpan Layanan' : 'Perbarui Layanan' }}
                        </button>
                        <a href="{{ route('admin.layanan.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-10 py-4 rounded-2xl font-bold transition-all">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </main>

</body>
</html>