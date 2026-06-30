<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IDENTRA STUDIO - Premium Creative Agency</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Mono:wght@400;600;800&family=Urbanist:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'urbanist': ['"Urbanist"', 'sans-serif'],
                        'mono-atkinson': ['"Atkinson Hyperlegible Mono"', 'monospace'],
                    },
                    colors: {
                        'id-gold': '#D4AF37',
                        'id-gold-light': '#F3E5AB',
                        'id-silver': '#E2E8F0',
                        'id-charcoal': '#0B0B0F',
                        'id-card-bg': 'rgba(255, 255, 255, 0.02)',
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Urbanist', sans-serif; background-color: #0B0B0F; overflow-x: hidden; }
        .glass-card { background: rgba(255, 255, 255, 0.01); border: 1px solid rgba(255, 255, 255, 0.04); backdrop-filter: blur(16px); }
        
        /* Efek Gradasi Emas dan Perak Cair */
        .text-gold-gradient { background: linear-gradient(135deg, #F3E5AB 0%, #D4AF37 50%, #AA7C11 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .text-silver-gradient { background: linear-gradient(135deg, #FFFFFF 0%, #CBD5E1 50%, #64748B 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .btn-gold-gradient { background: linear-gradient(135deg, #D4AF37 0%, #AA7C11 100%); }
        
        /* CSS Mobile Menu Trigger Toggle */
        #menu-toggle:checked ~ #mobile-menu { transform: translateX(0); opacity: 1; pointer-events: auto; }
        
        @keyframes ambient-glow {
            0% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(40px, -20px) scale(1.05); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .bg-glow { animation: ambient-glow 12s infinite ease-in-out; }
    </style>
</head>
<body class="text-slate-400 antialiased selection:bg-[#D4AF37] selection:text-black">

    <div class="fixed top-0 left-1/3 w-[600px] h-[500px] bg-slate-500/5 rounded-full blur-[140px] pointer-events-none bg-glow z-0"></div>

    <nav class="fixed top-0 inset-x-0 z-50 glass-card bg-black/50 border-b border-white/5 py-5 px-6 md:px-12 flex justify-between items-center">
        <h1 class="text-xl font-black tracking-widest text-white">IDENTRA<span class="text-id-gold">.</span></h1>
        
        <input type="checkbox" id="menu-toggle" class="hidden">
        
        <ul class="hidden md:flex items-center gap-8 text-xs font-semibold uppercase tracking-widest">
            <li><a href="#layanan" class="text-slate-300 hover:text-id-gold transition-colors">Layanan</a></li>
            <li><a href="#cara-kerja" class="text-slate-300 hover:text-id-gold transition-colors">Cara Kerja</a></li>
            <li><a href="#tentang-kami" class="text-slate-300 hover:text-id-gold transition-colors">Tentang Kami</a></li>
            <li><a href="{{ route('login') }}" class="border border-id-gold/30 text-id-gold hover:bg-id-gold hover:text-black px-5 py-2.5 rounded-xl transition-all duration-300">Workspace Access</a></li>
        </ul>

        <label for="menu-toggle" class="md:hidden cursor-pointer text-white text-xl z-50">
            <i class="fa-solid fa-bars"></i>
        </label>

        <div id="mobile-menu" class="fixed inset-0 min-h-screen w-full bg-id-charcoal/98 backdrop-blur-xl z-40 flex flex-col justify-center items-center gap-8 transition-all duration-300 transform translate-x-full opacity-0 pointer-events-none md:hidden">
            <label for="menu-toggle" class="absolute top-6 right-6 text-2xl text-gray-400"><i class="fa-solid fa-xmark"></i></label>
            <a href="#layanan" onclick="document.getElementById('menu-toggle').checked=false" class="text-xl font-bold uppercase tracking-widest text-white">Layanan</a>
            <a href="#cara-kerja" onclick="document.getElementById('menu-toggle').checked=false" class="text-xl font-bold uppercase tracking-widest text-white">Cara Kerja</a>
            <a href="#tentang-kami" onclick="document.getElementById('menu-toggle').checked=false" class="text-xl font-bold uppercase tracking-widest text-white">Tentang Kami</a>
            <a href="{{ route('login') }}" class="btn-gold-gradient text-black font-bold uppercase tracking-wider px-8 py-3 rounded-xl mt-4">Workspace Access</a>
        </div>
    </nav>

    <section class="relative min-h-screen pt-32 pb-24 md:pt-44 flex flex-col justify-center items-start px-6 md:px-12 lg:px-24 border-b border-white/5 bg-cover bg-center" style="background-image: linear-gradient(to right, #0B0B0F 45%, rgba(11,11,15,0.4)), url('{{ asset('img/image.png') }}');">
        <div class="max-w-4xl z-10 space-y-5">
            <h3 class="text-xs md:text-sm text-id-gold font-bold tracking-[0.3em] font-mono-atkinson uppercase">
                 Innovative Digital Entertainment & Creative Art
            </h3>
            
            <div class="space-y-1 md:space-y-2">
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white leading-none tracking-tighter">IDENTITY</h1>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-silver-gradient leading-none tracking-tighter">ENTERTAINMENT</h1>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-gold-gradient leading-none tracking-tighter">TRANSFORM</h1>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white/20 leading-none tracking-tighter">STUDIO<span class="text-id-gold">.</span></h1>
            </div>

            <p class="text-sm md:text-base text-slate-400 max-w-xl font-light leading-relaxed pt-2">
                Kami merancang infrastruktur visual megah dan eksklusif untuk memperkuat identitas korporasi Anda. Kombinasi mahakarya sinematik dan transformasi digital premium.
            </p>

            <div class="pt-6">
                <button onclick="location.href='{{ route('login') }}'" class="group btn-gold-gradient text-black font-black tracking-wider text-xs md:text-sm px-8 py-4 rounded-xl transition-all duration-300 shadow-lg shadow-yellow-600/10 flex items-center gap-3 active:scale-95">
                    MULAI PROYEK EKSKLUSIF <i class="fa-solid fa-arrow-right group-hover:translate-x-1.5 transition-transform"></i>
                </button>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute bottom-0 left-0 w-full z-0 pointer-events-none block">
            <path fill="#0B0B0F" d="M0,96L60,112C120,128,240,144,360,138.7C480,133,600,107,720,112C840,117,960,155,1080,154.7C1200,155,1320,117,1380,98L1440,80L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
        </svg>
    </section>

    <section id="layanan" class="py-24 px-6 md:px-12 lg:px-24 space-y-12 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h4 class="text-xs font-bold text-id-gold font-mono-atkinson tracking-widest uppercase"> 01 LAYANAN UTAMA</h4>
                <h2 class="text-3xl md:text-5xl font-black text-white mt-2 tracking-tight">STRATEGI BRANDING<br>VISUAL MAHA MEGAH</h2>
            </div>
            <p class="text-slate-400 text-sm max-w-sm font-light">Eksplorasi produksi media papan atas terintegrasi untuk memperkuat impresi pasar perusahaan Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-6">
            
            <div class="glass-card p-8 rounded-[20px] flex flex-col justify-between h-[380px] hover:border-id-gold/20 transition-all duration-300 group">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-lg text-id-gold group-hover:bg-id-gold group-hover:text-black transition-all">
                        <i class="fa-solid fa-video"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white tracking-wide">Film Production</h3>
                    <p class="text-xs text-slate-400 font-light leading-relaxed">
                        Produksi video berstandar layar lebar untuk kebutuhan korporat kelas dunia: Official Company Profile, Komersial TVC, Safety Induction, dan Sinematik Event.
                    </p>
                </div>
                <a href="{{ route('login') }}" class="text-xs font-bold text-id-gold tracking-widest flex items-center gap-2 pt-4 transition-colors">
                    REQUEST PROYEK <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            </div>

            <div class="glass-card p-8 rounded-[20px] flex flex-col justify-between h-[380px] hover:border-id-gold/20 transition-all duration-300 group">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-lg text-id-gold group-hover:bg-id-gold group-hover:text-black transition-all">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white tracking-wide">Video Animation</h3>
                    <p class="text-xs text-slate-400 font-light leading-relaxed">
                        Visualisasi grafis bergerak mutakhir: High-End Explainer Video, Animasi 2D/3D Mockup Sistem, Motion Graphic Asset Komplit, dan Presentasi Media.
                    </p>
                </div>
                <a href="{{ route('login') }}" class="text-xs font-bold text-id-gold tracking-widest flex items-center gap-2 pt-4 transition-colors">
                    REQUEST PROYEK <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            </div>

            <div class="glass-card p-8 rounded-[20px] flex flex-col justify-between h-[380px] hover:border-id-gold/20 transition-all duration-300 group">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-lg text-id-gold group-hover:bg-id-gold group-hover:text-black transition-all">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white tracking-wide">Design & IT Support</h3>
                    <p class="text-xs text-slate-400 font-light leading-relaxed">
                        Pondasi arsitektur sistem informasi premium agensi: Identitas Visual Brand Komplit, Website Korporat responsif, Landing Page, dan Custom Web App.
                    </p>
                </div>
                <a href="{{ route('login') }}" class="text-xs font-bold text-id-gold tracking-widest flex items-center gap-2 pt-4 transition-colors">
                    REQUEST PROYEK <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            </div>

        </div>
    </section>

    <section id="cara-kerja" class="py-24 bg-black/20 border-y border-white/5 px-6 md:px-12 lg:px-24">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
            
            <div>
                <h4 class="text-xs font-bold text-id-gold font-mono-atkinson tracking-widest uppercase"> 02 METODOLOGI KERJA</h4>
                <h2 class="text-3xl md:text-5xl font-black text-white mt-2 tracking-tight">HOW WE<br>DO IT</h2>
                <p class="text-slate-400 text-xs md:text-sm mt-4 font-light leading-relaxed max-w-xs">
                    Rangkaian proses kerja taktis terukur untuk memastikan kualitas mutu produk digital Anda terjamin secara presisi.
                </p>
            </div>

            <div class="lg:col-span-2 space-y-8">
                <div class="flex gap-6 items-start border-b border-white/5 pb-6">
                    <span class="text-2xl md:text-3xl font-black text-id-gold/30 font-mono-atkinson">#1</span>
                    <div class="space-y-1">
                        <h3 class="text-lg md:text-xl font-bold text-white">Briefing & High Brainstorming</h3>
                        <p class="text-xs md:text-sm text-slate-400 font-light leading-relaxed">
                            Penyelarasan ekspektasi konsep ide bersama jajaran manajemen klien. Pengamanan berkas arsip awal dijamin aman dalam ekosistem korporasi.
                        </p>
                    </div>
                </div>

                <div class="flex gap-6 items-start border-b border-white/5 pb-6">
                    <span class="text-2xl md:text-3xl font-black text-id-gold/30 font-mono-atkinson">#2</span>
                    <div class="space-y-1">
                        <h3 class="text-lg md:text-xl font-bold text-white">Premium Execution Workspace</h3>
                        <p class="text-xs md:text-sm text-slate-400 font-light leading-relaxed">
                            Eksekusi pembuatan aset digital terkontrol. Pergerakan grafik kemajuan proyek dikomunikasikan secara transparan via client workspace.
                        </p>
                    </div>
                </div>

                <div class="flex gap-6 items-start">
                    <span class="text-2xl md:text-3xl font-black text-id-gold/30 font-mono-atkinson">#3</span>
                    <div class="space-y-1">
                        <h3 class="text-lg md:text-xl font-bold text-white">Flawless Delivery & Handover</h3>
                        <p class="text-xs md:text-sm text-slate-400 font-light leading-relaxed">
                            Penyerahan output karya final dengan resolusi maksimal yang sah. Berkas terarsip otomatis di cloud server proyek secara terstruktur.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="tentang-kami" class="py-32 px-6 md:px-12 lg:px-24 text-center max-w-4xl mx-auto space-y-8">
        <h4 class="text-xs font-bold text-id-gold font-mono-atkinson tracking-widest uppercase"> 03 PROFILE STUDIO</h4>
        <h2 class="text-2xl md:text-4xl font-extrabold text-white text-gold-gradient tracking-tight leading-snug">
            "Berkembang Bersama dan Selalu Berinovasi dengan karya. We are the decisive factor behind your success."
        </h2>
        <p class="text-xs md:text-sm text-slate-400 leading-relaxed font-light max-w-2xl mx-auto">
            Identra Studio merupakan Rumah Produksi ekonomi kreatif premium yang didirikan secara resmi pada tahun 2026. Kami berfokus penuh dalam melayani perancangan infrastruktur visual strategis skala besar dari instansi Swasta Multinasional maupun BUMN.
        </p>
    </section>

    <footer class="bg-black/40 border-t border-white/5 pt-16 pb-8 px-6 md:px-12 lg:px-24">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 border-b border-white/5 pb-12 mb-8">
            
            <div class="space-y-4">
                <h2 class="text-2xl font-black text-white tracking-wider">IDENTRA STUDIO<span class="text-id-gold">.</span></h2>
                <p class="text-xs text-slate-500 font-light leading-relaxed">
                    Providing top-tier creative visual infrastructure layout setups for premium businesses nationwide.
                </p>
            </div>

            <div class="space-y-3">
                <h4 class="text-xs font-bold text-white font-mono-atkinson tracking-widest uppercase"> CHANNELS</h4>
                <ul class="text-xs text-slate-400 space-y-2">
                    <li><span class="text-slate-600">Kontak:</span> +62 852-3373-1724</li>
                    <li><span class="text-slate-600">Gmail:</span> admin@identrastudio.com</li>
                </ul>
            </div>

            <div class="space-y-3">
                <h4 class="text-xs font-bold text-white font-mono-atkinson tracking-widest uppercase"> HEADQUARTER</h4>
                <p class="text-xs text-slate-400 font-light leading-relaxed">
                    Jl. Dr. Ir. H. Soekarno, Mulyorejo, Kec. Mulyorejo, Surabaya, Jawa Timur 60115
                </p>
            </div>

        </div>

        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-500">
            <p>&copy; 2026 Identra Studio. All rights reserved.</p>
            <p class="font-mono-atkinson tracking-wider text-[10px] text-id-gold/40">PROVIDING CREATIVE IDEAS FOR YOUR BUSINESS</p>
        </div>
    </footer>

</body>
</html>