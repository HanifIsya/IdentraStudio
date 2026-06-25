<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Identra Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 'urbanist': ['"Urbanist"', 'sans-serif'] },
                    colors: { 'id-purple': '#A855F7', 'id-dark': '#0f051a' }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Urbanist', sans-serif; background: linear-gradient(135deg, #1E0A2E 0%, #000000 100%); min-height: 100vh; color: white; display: flex; overflow: hidden; }
        .sidebar { width: 260px; background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(20px); border-right: 1px solid rgba(255,255,255,0.05); padding: 30px 20px; height: 100vh; display: flex; flex-direction: column; }
        .glass-card { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); backdrop-filter: blur(12px); border-radius: 24px; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 14px; color: #94A3B8; transition: 0.3s; text-decoration: none; margin-bottom: 4px; }
        .nav-link:hover, .nav-link.active { background: rgba(168, 85, 247, 0.15); color: white; }
        .status-badge { padding: 4px 12px; border-radius: 99px; font-size: 10px; font-weight: 700; text-transform: uppercase; }
        .status-pending { background: rgba(245, 158, 11, 0.2); color: #F59E0B; }
        .status-progress { background: rgba(59, 130, 246, 0.2); color: #3B82F6; }
        .status-success { background: rgba(34, 197, 94, 0.2); color: #22C55E; }
        main { flex: 1; padding: 40px; overflow-y: auto; height: 100vh; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="font-black text-3xl mb-12 tracking-tighter">IDENTRA<br>STUDIO.</div>
        
        <div class="flex flex-col items-center mb-10 pb-8 border-b border-white/5">
            <div class="w-20 h-20 rounded-full border-2 border-id-purple p-1 mb-4">
                <img src="https://ui-avatars.com/api/?name=Admin&background=A855F7&color=fff" class="w-full h-full rounded-full object-cover">
            </div>
            <h4 class="font-bold text-xl">Admin</h4>
            <p class="text-xs text-id-gray opacity-50">admin.identra@gmail.com</p>
        </div>

        <nav class="flex-grow">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-users-gear"></i><span>User Management</span></a>
            <a href="{{ route('admin.layanan.index') }}" class="nav-link"><i class="fa-solid fa-boxes-packing"></i><span>Layanan</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-file-invoice-dollar"></i><span>Transaksi</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-briefcase"></i><span>Project Client</span></a>
            <a href="#" class="nav-link"><i class="fa-solid fa-folder-open"></i><span>File & Asset</span></a>
            <a href="{{ route('chat.index') }}" class="nav-link {{ Route::is('chat.index') ? 'active' : '' }}">
                <i class="fa-solid fa-comments"></i><span>Chat Support</span>
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link w-full text-left bg-transparent border-none cursor-pointer mt-auto">
                <i class="fa-solid fa-power-off text-red-500"></i><span>Logout</span>
            </button>
        </form>
    </aside>

    <main>
        <header class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-4xl font-black text-white">Hello Admin !</h1>
                <p class="text-id-gray opacity-60 mt-1">Today is {{ date('l, d F Y') }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl glass-card flex items-center justify-center border border-white/10">
                <i class="fa-solid fa-bell text-yellow-400"></i>
            </div>
        </header>

        {{-- Stats Section --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="glass-card p-6 flex justify-between items-center">
                <div>
                    <p class="text-sm opacity-60 font-medium">Total User</p>
                    <h2 class="text-4xl font-black mt-1">{{ $stats['total_user'] }}</h2>
                    <p class="text-[11px] text-green-400 mt-2"><i class="fa-solid fa-arrow-up"></i> +12% this month</p>
                </div>
                <div class="text-4xl opacity-20 text-white"><i class="fa-solid fa-users"></i></div>
            </div>
            <div class="glass-card p-6 flex justify-between items-center">
                <div>
                    <p class="text-sm opacity-60 font-medium">Total Order</p>
                    <h2 class="text-4xl font-black mt-1">{{ $stats['total_order'] }}</h2>
                    <p class="text-[11px] text-green-400 mt-2"><i class="fa-solid fa-arrow-up"></i> +18% this month</p>
                </div>
                <div class="text-4xl opacity-20 text-white"><i class="fa-solid fa-cart-shopping"></i></div>
            </div>
            <div class="glass-card p-6 flex justify-between items-center bg-id-purple/10 border-id-purple/20">
                <div>
                    <p class="text-sm opacity-60 font-medium text-id-purple">Total Revenue</p>
                    <h2 class="text-3xl font-black mt-1 text-white">{{ $stats['total_revenue'] }}</h2>
                    <p class="text-[11px] text-green-400 mt-2"><i class="fa-solid fa-arrow-up"></i> +10% this month</p>
                </div>
                <div class="text-4xl text-id-purple opacity-40"><i class="fa-solid fa-wallet"></i></div>
            </div>
        </div>

        {{-- Project Table --}}
        <div class="glass-card p-8 mb-10">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-bold text-white">Project Client Terbaru</h3>
                <a href="#" class="text-sm text-id-purple font-bold hover:underline">Lihat Semua</a>
            </div>
            <table class="w-full text-left">
                <thead class="text-xs opacity-40 uppercase border-b border-white/5">
                    <tr>
                        <th class="pb-4">Client</th>
                        <th class="pb-4">Layanan</th>
                        <th class="pb-4">Progress</th>
                        <th class="pb-4 text-center">Status</th>
                        <th class="pb-4">Deadline</th>
                        <th class="pb-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b border-white/5">
                        <td class="py-5 font-bold text-white">Rizky Pratama</td>
                        <td class="text-white/80">Website Design</td>
                        <td class="w-48">
                            <div class="h-1.5 w-full bg-white/5 rounded-full">
                                <div class="h-full bg-id-purple rounded-full" style="width:70%"></div>
                            </div>
                        </td>
                        <td class="text-center"><span class="status-badge status-progress">Progress</span></td>
                        <td class="text-white/80">15 Mar 2026</td>
                        <td class="text-center"><button class="text-white/40 hover:text-white"><i class="fa-solid fa-ellipsis"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- INTERAKTIF TO-DO LIST (Project Milestones) --}}
        <div class="glass-card p-8 mb-10">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-white">Project Milestones</h3>
                    <p class="text-xs opacity-50">Tracking pengerjaan internal tim Identra</p>
                </div>
                <span id="task-stats" class="bg-id-purple/20 text-id-purple px-3 py-1 rounded-full text-[10px] font-bold uppercase">
                    0 Tasks Remaining
                </span>
            </div>

            <div class="flex gap-4 mb-8">
                <input type="text" id="todo-input" 
                    class="flex-1 bg-white/5 border border-white/10 rounded-xl px-5 py-3 text-white text-sm focus:outline-none focus:border-id-purple transition-all" 
                    placeholder="Input milestone baru (contoh: Slicing UI Dashboard)...">
                <button id="todo-add-btn" 
                    class="bg-id-purple hover:bg-purple-600 text-white px-6 py-3 rounded-xl font-bold text-sm transition-all flex items-center gap-2">
                    <i class="fa-solid fa-plus text-xs"></i> Add
                </button>
            </div>

            <div id="todo-list" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Tasks akan muncul di sini via JavaScript --}}
            </div>
        </div>

        {{-- Bottom Widgets Row --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="glass-card p-6">
                <h4 class="font-bold mb-6 text-white">Chat Support</h4>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Rizky" class="w-10 h-10 rounded-xl">
                        <div class="flex-grow">
                            <p class="text-sm font-bold text-white">Rizky Pratama</p>
                            <p class="text-[10px] opacity-50 truncate w-32">I have a problem with my order...</p>
                        </div>
                        <span class="text-[9px] opacity-40">10:42 AM</span>
                    </div>
                </div>
            </div>

            <div class="glass-card p-6 text-white">
                <h4 class="font-bold mb-6">File Project Terbaru</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-file-pdf text-red-500"></i>
                            <div><p class="text-xs font-bold">Proposal.pdf</p><p class="text-[9px] opacity-40">Rizky P.</p></div>
                        </div>
                        <i class="fa-solid fa-download text-xs opacity-50"></i>
                    </div>
                </div>
            </div>

            <div class="glass-card p-6 text-white">
                <h4 class="font-bold mb-6">Notifikasi</h4>
                <div class="space-y-4 text-xs">
                    <div class="flex gap-3">
                        <i class="fa-solid fa-circle-dot text-id-purple mt-1"></i>
                        <p><strong>Order baru</strong> dari Rizky Pratama telah masuk.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Pemanggilan JavaScript File --}}
    <script src="{{ asset('js/todo.js') }}"></script>
</body>
</html>