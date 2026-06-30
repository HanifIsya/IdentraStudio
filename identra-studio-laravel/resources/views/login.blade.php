<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Workspace - Identra Studio</title>
    
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
                <p class="text-xs font-mono-atkinson text-id-gold tracking-widest uppercase mt-2"> ACCESS WORKSPACE</p>
            </div>

            <div class="space-y-1 mb-6">
                <h2 class="text-xl font-bold text-white tracking-tight">Selamat Datang</h2>
                <p class="text-xs text-slate-400 font-light leading-relaxed">Silakan masukkan kredensial terdaftar untuk masuk ke panel studio Anda.</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-3.5 rounded-xl text-xs flex items-center gap-2.5 mb-4 animate-fade-in">
                    <i class="fa-solid fa-circle-exclamation flex-shrink-0"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form class="space-y-5" action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400" for="Email">Alamat Email</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-slate-500 text-xs"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" id="Email" name="Email" value="{{ old('Email') }}" 
                               placeholder="nama@perusahaan.com" 
                               class="w-full bg-white/[0.02] border border-white/5 rounded-xl pl-11 pr-4 py-3 text-xs text-white placeholder:text-slate-600 focus:outline-none focus:border-id-gold/40 focus:bg-white/[0.04] transition-all" required>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400" for="Password">Kata Sandi</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-slate-500 text-xs"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" id="Password" name="Password" 
                               placeholder="••••••••" 
                               class="w-full bg-white/[0.02] border border-white/5 rounded-xl pl-11 pr-4 py-3 text-xs text-white placeholder:text-slate-600 focus:outline-none focus:border-id-gold/40 focus:bg-white/[0.04] transition-all" required>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center cursor-pointer select-none text-xs text-slate-400 font-light">
                        <input type="checkbox" id="remember" name="remember" class="accent-id-gold rounded mr-2 bg-transparent border-white/10">
                        Ingat sesi saya
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-gradient-to-r from-id-gold to-[#AA7C11] text-black text-xs uppercase tracking-widest font-black py-3.5 px-6 rounded-xl transition-all duration-300 hover:opacity-90 active:scale-[0.98] shadow-lg shadow-yellow-600/5">
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-white/5 flex flex-col sm:flex-row items-center justify-center gap-1.5 text-xs text-slate-500">
                <span>Belum memiliki akun client?</span>
                <a class="text-id-gold hover:text-id-gold-light font-bold hover:underline transition-colors" href="{{ route('register') }}">
                    Daftar Akun Baru <i class="fa-solid fa-angle-right text-[10px] ml-0.5"></i>
                </a>
            </div>

        </div>
    </section>

</body>
</html>