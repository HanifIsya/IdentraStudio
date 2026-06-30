<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Workspace - Identra Studio</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Mono:wght@400;600&family=Urbanist:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-id-charcoal font-urbanist text-slate-300 min-h-screen relative flex items-center justify-center overflow-x-hidden antialiased">

    <div class="absolute top-12 left-1/2 -translate-x-1/2 w-[350px] md:w-[500px] h-[350px] md:h-[500px] bg-slate-500/5 rounded-full blur-[100px] md:blur-[130px] pointer-events-none z-0"></div>

    <a href="{{ route('home') }}" class="absolute top-6 left-6 text-xs font-mono-atkinson uppercase tracking-widest text-slate-500 hover:text-id-gold transition-colors flex items-center gap-2 z-10">
        <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Beranda
    </a>

    <section class="w-full max-w-md p-4 z-10">
        <div class="bg-id-card border border-id-border backdrop-blur-xl shadow-2xl rounded-2xl p-8 md:p-10 flex flex-col relative overflow-hidden">
            
            <div class="text-center mb-8">
                <h1 class="text-2xl font-black tracking-widest text-white">IDENTRA<span class="text-id-gold">.</span></h1>
                <p class="text-xs font-mono-atkinson text-id-gold tracking-widest uppercase mt-2"> CREATE ACCOUNT</p>
            </div>

            <div class="space-y-1 mb-6">
                <h2 class="text-xl font-bold text-white tracking-tight">Buat Akun Baru</h2>
                <p class="text-xs text-slate-400 font-light leading-relaxed">Lengkapi data diri Anda untuk memulai perjalanan proyek kreatif bersama kami.</p>
            </div>

            <form class="space-y-4" action="{{ route('register') }}" method="POST">
                @csrf
                
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400" for="Nama">Nama Lengkap</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-slate-500 text-xs"><i class="fa-solid fa-user"></i></span>
                        <input type="text" id="Nama" name="Nama" value="{{ old('Nama') }}" 
                               placeholder="Nama lengkap Anda" 
                               class="w-full bg-white/[0.02] border @error('Nama') border-red-500/50 @else border-white/5 @enderror rounded-xl pl-11 pr-4 py-3 text-xs text-white placeholder:text-slate-600 focus:outline-none focus:border-id-gold/40 focus:bg-white/[0.04] transition-all" required>
                    </div>
                    @error('Nama') 
                        <span class="text-red-400 text-[10px] block mt-1"><i class="fa-solid fa-circle-exclamation mr-0.5"></i> {{ $message }}</span> 
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400" for="Email">Alamat Email</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-slate-500 text-xs"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" id="Email" name="Email" value="{{ old('Email') }}" 
                               placeholder="nama@perusahaan.com" 
                               class="w-full bg-white/[0.02] border @error('Email') border-red-500/50 @else border-white/5 @enderror rounded-xl pl-11 pr-4 py-3 text-xs text-white placeholder:text-slate-600 focus:outline-none focus:border-id-gold/40 focus:bg-white/[0.04] transition-all" required>
                    </div>
                    @error('Email') 
                        <span class="text-red-400 text-[10px] block mt-1"><i class="fa-solid fa-circle-exclamation mr-0.5"></i> {{ $message }}</span> 
                    @enderror
                </div>
                
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400" for="Password">Kata Sandi</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-slate-500 text-xs"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" id="Password" name="Password" 
                               placeholder="Minimal 6 karakter" 
                               class="w-full bg-white/[0.02] border @error('Password') border-red-500/50 @else border-white/5 @enderror rounded-xl pl-11 pr-4 py-3 text-xs text-white placeholder:text-slate-600 focus:outline-none focus:border-id-gold/40 focus:bg-white/[0.04] transition-all" required>
                    </div>
                    @error('Password') 
                        <span class="text-red-400 text-[10px] block mt-1"><i class="fa-solid fa-circle-exclamation mr-0.5"></i> {{ $message }}</span> 
                    @enderror
                </div>

                <div class="flex items-start pt-1">
                    <input type="checkbox" id="ketentuan" name="ketentuan" class="accent-id-gold rounded mt-0.5 mr-2.5 bg-transparent border-white/10" required>
                    <label class="cursor-pointer select-none text-[11px] text-slate-400 font-light leading-normal" for="ketentuan"> 
                        Saya setuju dengan <span class="text-white hover:underline">Syarat & Ketentuan</span> serta <span class="text-white hover:underline">Kebijakan Privasi</span> Identra Studio.
                    </label>
                </div>
                
                <div class="pt-3">
                    <button type="submit" class="w-full bg-gradient-to-r from-id-gold to-[#AA7C11] text-black text-xs uppercase tracking-widest font-black py-3.5 px-6 rounded-xl transition-all duration-300 hover:opacity-90 active:scale-[0.98] shadow-lg shadow-yellow-600/5">
                        Daftar Akun Baru
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-white/5 flex flex-col sm:flex-row items-center justify-center gap-1.5 text-xs text-slate-500">
                <span>Sudah memiliki akun?</span>
                <a class="text-id-gold hover:text-id-gold-light font-bold hover:underline transition-colors" href="{{ route('login') }}">
                    Masuk Sekarang <i class="fa-solid fa-angle-right text-[10px] ml-0.5"></i>
                </a>
            </div>

        </div>
    </section>

</body>
</html>