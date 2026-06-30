<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mode == 'tambah' ? 'Tambah' : 'Edit' }} Layanan - Admin Headquarters</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Mono:wght@400;600&family=Urbanist:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Urbanist', sans-serif;
            background-color: #EFEFF2; /* Soft Cool Platinum */
            color: #2B2B30; /* Charcoal Graphite */
        }

        /* Sidebar Matte Charcoal Mewah & Ramping */
        .sidebar {
            width: 250px;
            min-width: 250px;
            background-color: #1E1E24;
            color: #FFFFFF;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.02);
            z-index: 30;
            display: flex;
            flex-direction: column;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            color: #9CA3AF;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.25s ease;
            text-decoration: none;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.04);
            color: #FFFFFF;
        }

        .nav-link.active {
            background-color: rgba(212, 175, 55, 0.1);
            color: #D4AF37;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .main-workspace {
            margin-left: 250px;
            padding: 32px 48px;
            min-height: 100vh;
        }

        /* Container Card Style Studio */
        .studio-card {
            background-color: #FAFAFA;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.02);
        }

        /* Kustomisasi Form Control Premium */
        .studio-input {
            background-color: #FFFFFF !important;
            border: 1px solid #DDE1E6 !important;
            color: #2B2B30 !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            transition: all 0.2s ease;
        }
        .studio-input:focus {
            border-color: #D4AF37 !important;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1) !important;
            outline: none !important;
        }
    </style>
</head>
<body class="min-h-screen">

    <aside class="sidebar p-6 py-8">
        <div class="px-2 pt-2 mb-8">
            <h1 class="text-lg font-black tracking-wider text-white">IDENTRA<span class="text-id-gold">.</span><span class="text-[10px] ml-1.5 px-1.5 py-0.5 bg-id-gold/10 text-id-gold rounded font-bold uppercase tracking-widest border border-id-gold/20">HQ</span></h1>
        </div>

        <div class="flex items-center gap-3 bg-white/[0.03] p-3 rounded-xl border border-white/5 mb-6">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-id-gold/20 to-white/5 flex items-center justify-center font-bold text-sm text-id-gold border border-id-gold/20">
                {{ strtoupper(substr(auth()->user()->Nama, 0, 2)) }}
            </div>
            <div class="min-w-0 flex-1">
                <h4 class="text-xs font-bold truncate text-white leading-tight">{{ auth()->user()->Nama }}</h4>
                <p class="text-[10px] text-gray-400 truncate mt-0.5">{{ auth()->user()->Email }}</p>
            </div>
        </div>

        <nav class="space-y-1 flex-grow">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fa-solid fa-chart-line w-5 text-center"></i> <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.user.index') }}" class="nav-link">
                <i class="fa-solid fa-users-gear w-5 text-center"></i> <span>User Management</span>
            </a>
            <a href="{{ route('admin.layanan.index') }}" class="nav-link active">
                <i class="fa-solid fa-boxes-packing w-5 text-center"></i> <span>Layanan</span>
            </a>
            <a href="{{ route('admin.transaction.index') }}" class="nav-link {{ Route::is('admin.transaction.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-invoice-dollar w-5 text-center"></i> <span>Transaksi</span>
            </a>
            <a href="{{ route('admin.project.index') }}" class="nav-link {{ Route::is('admin.project.*') ? 'active' : '' }}">
                <i class="fa-solid fa-briefcase w-5 text-center"></i> <span>Project Client</span>
            </a>
            <a href="{{ route('admin.asset.index') }}" class="nav-link {{ Route::is('admin.asset.index') ? 'active' : '' }}">
                <i class="fa-solid fa-folder-open w-5 text-center"></i> <span>File & Asset</span>
            </a>
            <a href="{{ route('chat.index') }}" class="nav-link {{ Route::is('chat.index') ? 'active' : '' }}">
                <i class="fa-solid fa-comments w-5 text-center"></i> <span>Chat Support</span>
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" class="pt-4 border-t border-white/5 mt-auto">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-400 hover:text-red-400 transition-colors text-left cursor-pointer">
                <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> <span>Logout Sesi</span>
            </button>
        </form>
    </aside>

    <main class="main-workspace">
        
        <header class="mb-10">
            <a href="{{ route('admin.layanan.index') }}" class="text-xs font-bold text-slate-500 hover:text-id-gold transition-colors flex items-center gap-1.5 no-underline">
                <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Inventaris
            </a>
            <div class="space-y-0.5 mt-4">
                <span class="text-[10px] font-mono-atkinson text-id-gold font-bold uppercase tracking-widest"> SERVICE EDITOR CONTROL</span>
                <h1 class="text-3xl font-black text-[#2B2B30] tracking-tight">{{ $mode == 'tambah' ? 'Tambah Layanan Baru' : 'Edit Kustomisasi Layanan' }}</h1>
            </div>
        </header>

        <div class="max-w-3xl">
            <div class="studio-card p-8 md:p-10">
                
                <form action="{{ $mode == 'tambah' ? route('admin.layanan.store') : route('admin.layanan.update', $layanan->Layanan_ID) }}" method="POST">
                    @csrf
                    @if($mode == 'edit')
                        @method('PUT')
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-600 px-5 py-4 rounded-xl mb-8">
                            <div class="flex items-center gap-2 mb-2 font-bold text-xs">
                                <i class="fa-solid fa-circle-exclamation text-sm"></i> Terdapat kesalahan pengisian berkas form:
                            </div>
                            <ul class="list-disc pl-5 text-[11px] space-y-1 font-semibold">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2 space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Nama Layanan</label>
                            <input type="text" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}" 
                                   class="studio-input w-full px-4 py-3 rounded-xl placeholder:text-slate-400" placeholder="Contoh: Website Design" required>
                        </div>

                        <div class="md:col-span-2 space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Tagline (Deskripsi Singkat)</label>
                            <input type="text" name="tagline" value="{{ old('tagline', $layanan->tagline) }}" 
                                   class="studio-input w-full px-4 py-3 rounded-xl placeholder:text-slate-400" placeholder="Contoh: Jasa pembuatan arsitektur web korporasi" required>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Ikon Representasi</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-[#AA7C11] text-xs z-10">
                                    <i id="icon-preview" class="{{ old('ikon', $layanan->ikon ?? 'fa-solid fa-icons') }}"></i>
                                </span>
                                
                                <select name="ikon" id="icon-select" onchange="updateIconPreview()" class="studio-input w-full pl-11 pr-10 py-3 rounded-xl cursor-pointer appearance-none" required>
                                    @php
                                        $icons = [
                                            'fa-solid fa-pen-nib' => 'Design & Kreatif (Pen Nib)',
                                            'fa-solid fa-desktop' => 'Web Development (Desktop)',
                                            'fa-solid fa-mobile-screen-button' => 'Mobile Apps (Smartphone)',
                                            'fa-solid fa-code' => 'Software / Coding (Code)',
                                            'fa-solid fa-chart-line' => 'SEO & Marketing (Chart)',
                                            'fa-solid fa-camera' => 'Photography / Media (Camera)',
                                            'fa-solid fa-palette' => 'UI/UX Styling (Palette)',
                                            'fa-solid fa-wand-magic-sparkles' => 'Branding / Efek (Magic)',
                                            'fa-solid fa-shop' => 'E-Commerce Platform (Shop)',
                                            'fa-solid fa-bullhorn' => 'Advertising Jasa (Bullhorn)',
                                            'fa-solid fa-server' => 'Hosting / Cloud Server (Server)',
                                            'fa-solid fa-shield-halved' => 'Keamanan Sistem (Shield)'
                                        ];
                                        $currentIcon = old('ikon', $layanan->ikon);
                                    @endphp

                                    @foreach($icons as $value => $label)
                                        <option value="{{ $value }}" {{ $currentIcon == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute right-4 text-slate-400">
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Nilai Kontrak Base (IDR)</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400 text-xs font-bold">
                                    Rp
                                </span>
                                <input type="number" id="harga" name="harga" value="{{ $layanan->harga ?? '' }}"
                                       placeholder="5000000" 
                                       class="w-full studio-card pl-11 pr-4 py-3 text-xs font-mono-atkinson text-[#2B2B30] focus:outline-none focus:border-id-gold/30 placeholder:text-slate-400" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:col-span-3 space-y-1.5 pt-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Rincian Fitur Unggulan (Dipisahkan koma)</label>
                            <textarea name="fitur" rows="4" placeholder="Contoh: Responsive Design, Integrasi Midtrans, Free Domain 1 Tahun..." 
                                      class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-[#2B2B30] focus:outline-none focus:border-id-gold/30 placeholder:text-slate-400 transition-all font-medium leading-relaxed" required>{{ is_array($layanan->fitur ?? null) ? implode(', ', $layanan->fitur) : ($layanan->fitur ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex justify-end gap-3 mt-8">
                        <a href="{{ route('admin.layanan.index') }}" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-bold text-xs px-5 py-3 rounded-xl transition-all active:scale-95 no-underline">
                            Batalkan
                        </a>
                        <button type="submit" class="bg-gradient-to-r from-id-gold to-[#AA7C11] text-black font-black text-xs uppercase tracking-widest px-5 py-3 rounded-xl active:scale-95 shadow-sm cursor-pointer">
                            Simpan Struktur Jasa
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </main>

    <script>
        // Driver update icon dinamis internal preview jika diperlukan
        document.getElementById('todo-input')?.addEventListener('focus', function() {
            this.style.borderColor = '#D4AF37';
        });
    </script>
</body>
</html>