<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Identra Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Iceland&family=Urbanist:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'iceland': ['"Iceland"', 'sans-serif'],
                        'urbanist': ['"Urbanist"', 'sans-serif'],
                    },
                    colors: {
                        'id-purple': '#A855F7',
                        'id-purple-dark': '#1E0A2E',
                        'id-purple-mid': '#2D1040',
                        'id-blue': '#3B82F6',
                        'id-gray': '#94A3B8',
                        'id-card': '#1A1A2E',
                    }
                }
            }
        }
    </script>
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: 'Urbanist', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            color: white;
            background: linear-gradient(to bottom, #2D0A4E 0%, #6B1FA0 20%, #B06FD8 50%, #E8C8F5 80%, #F5EEF8 100%);
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            min-width: 220px;
            display: flex;
            flex-direction: column;
            padding: 28px 20px;
            background: rgba(20, 5, 35, 0.55);
            backdrop-filter: blur(16px);
            border-right: 1px solid rgba(255,255,255,0.08);
            gap: 24px;
            height: 100vh;
        }

        .sidebar-logo {
            font-family: 'Urbanist', sans-serif;
            font-weight: 900;
            font-size: 22px;
            line-height: 1.1;
            letter-spacing: -0.5px;
            color: white;
        }

        .sidebar-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            gap: 8px;
        }

        .avatar-ring {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            border: 3px solid #A855F7;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1E0A2E;
            font-size: 28px;
            font-weight: 800;
            color: white;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            color: #94A3B8;
            transition: all 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.08);
            color: white;
        }

        .nav-link.active {
            background: rgba(168, 85, 247, 0.15);
            color: white;
        }

        .nav-link i {
            width: 18px;
            font-size: 16px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'Urbanist', sans-serif;
            font-size: 15px;
            font-weight: 500;
            color: #94A3B8;
            width: 100%;
            text-align: left;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.08);
            color: white;
        }

        /* Main content */
        .main {
            flex: 1;
            padding: 32px 36px;
            overflow-y: auto;
            height: 100vh;
        }

        /* Glass card */
        .glass {
            background: rgba(255,255,255,0.92);
            border: 1px solid rgba(255,255,255,0.7);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            color: #1a1a2e;
        }

        .glass h3 { color: #1a1a2e; }
        .glass p { color: #333; }

        /* Service cards */
        .service-card {
            border-radius: 20px;
            padding: 20px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 10px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.15);
        }

        .service-card.white {
            background: white;
            color: #111;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .service-card.dark {
            background: rgba(255,255,255,0.88);
            border: 1px solid rgba(255,255,255,0.6);
            color: #1a1a2e;
        }

        .service-icon {
            font-size: 32px;
            margin-bottom: 4px;
        }

        /* Progress bar */
        .progress-bar {
            height: 8px;
            border-radius: 99px;
            background: rgba(0,0,0,0.1);
            overflow: hidden;
            flex: 1;
        }

        .progress-fill {
            height: 100%;
            border-radius: 99px;
            background: #3B82F6;
        }

        /* Project row */
        .project-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            background: rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 16px;
        }

        /* File icon box */
        .file-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        /* Chat support button */
        .chat-btn {
            position: fixed;
            bottom: 28px;
            right: 28px;
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            color: #111;
            border-radius: 99px;
            padding: 12px 20px;
            cursor: pointer;
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
            font-family: 'Urbanist', sans-serif;
            font-weight: 700;
            font-size: 15px;
            transition: transform 0.2s;
        }

        .chat-btn:hover {
            transform: translateY(-2px);
        }

        .chat-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #A855F7;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .new-chat-badge {
            background: #3B82F6;
            color: white;
            border-radius: 99px;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 700;
        }

        /* Notification bell */
        .notif-bell {
            position: relative;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            color: rgba(255,255,255,0.7);
        }

        .notif-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: #FACC15;
            border-radius: 50%;
            border: 2px solid #1A0A2E;
        }

        /* Scrollbar */
        .main::-webkit-scrollbar { width: 4px; }
        .main::-webkit-scrollbar-track { background: transparent; }
        .main::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">IDENTRA<br>STUDIO.</div>

        <div class="sidebar-profile">
            <div class="avatar-ring">
                {{ substr(auth()->user()->Nama, 0, 1) }}
            </div>
            <h4 style="font-size:16px; font-weight:700; margin:0;">{{ auth()->user()->Nama }}</h4>
            <p style="font-size:12px; color:#94A3B8; margin:0;">{{ auth()->user()->Email }}</p>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-link active">
                <i class="fa-solid fa-table-columns"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('layanan.index') }}" class="nav-link">
                <i class="fa-solid fa-layer-group"></i>
                <span>Layanan</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-credit-card"></i>
                <span>Transaction</span>
            </a>
            <a href="{{ route('project.tracking') }}" class="nav-link">
                <i class="fa-solid fa-location-dot"></i>
                <span>Tracking</span>
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <!-- Header -->
        <header style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:28px;">
            <div>
                <h1 style="font-size:32px; font-weight:800; margin:0;">Hello {{ explode(' ', auth()->user()->Nama)[0] }}!</h1>
                <p style="font-size:14px; color:#94A3B8; margin:4px 0 0;">Today is {{ date('l, d F Y') }}</p>
            </div>
            <div class="notif-bell">
                <i class="fa-solid fa-bell"></i>
                <span class="notif-dot"></span>
            </div>
        </header>

        <!-- Layanan -->
       <section style="margin-bottom:28px;">
    <h3 style="font-size:18px; font-weight:700; margin-bottom:16px;">Layanan</h3>
    <div style="display:grid; grid-template-columns:repeat(6,1fr); gap:12px;">
        
        @forelse($layanans as $layanan)
        <div class="group service-card bg-white/10 backdrop-blur-md border border-white/10 transition-all duration-300 hover:bg-white cursor-pointer" 
             style="border-radius:20px; padding:20px 16px; display:flex; flex-direction:column; align-items:center; text-align:center; gap:10px;">
            
            <div class="service-icon transition-colors duration-300 text-white group-hover:text-id-purple" style="font-size:32px; margin-bottom:4px;">
                <i class="fa-solid {{ $layanan->ikon }}"></i>
            </div>
            
            <p class="transition-colors duration-300 text-white group-hover:text-black" 
               style="font-weight:700; font-size:12px; margin:0;">
               {{ $layanan->nama_layanan }}
            </p>
            
            <p class="transition-colors duration-300 text-id-gray group-hover:text-gray-600" 
               style="font-size:10px; margin:0;">
               {{ $layanan->tagline }}
            </p>
        </div>
        @empty
        <div class="col-span-6 text-center py-10 opacity-50">
            <p>Belum ada layanan yang tersedia di database.</p>
        </div>
        @endforelse

    </div>
</section>

        <!-- Bottom grid -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; padding-bottom:90px;">

            <!-- Project Progress -->
            <div class="glass" style="padding:24px;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                    <h3 style="font-size:17px; font-weight:700; margin:0; color:#1a1a2e;">Project Progress</h3>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span style="font-size:12px; color:#6B7280;">Project Progress</span>
                        <div class="progress-bar" style="width:100px;">
                            <div class="progress-fill" style="width:70%;"></div>
                        </div>
                        <span style="font-size:16px; font-weight:800; color:#1a1a2e;">70%</span>
                    </div>
                </div>

                <div style="display:flex; flex-direction:column; gap:10px;">
                    <!-- Done -->
                    <div class="project-row">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <i class="fa-solid fa-circle-check" style="color:#22C55E; font-size:22px;"></i>
                            <div>
                                <p style="font-size:14px; font-weight:600; margin:0; color:#1a1a2e;">Requirements Gathering</p>
                                <p style="font-size:11px; color:#6B7280; margin:2px 0 0; font-style:italic;">Project Progress: 4/15/2026</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-circle-check" style="color:#22C55E; font-size:18px;"></i>
                    </div>

                    <!-- In Progress -->
                    <div class="project-row">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <i class="fa-solid fa-circle-check" style="color:#9CA3AF; font-size:22px;"></i>
                            <div>
                                <p style="font-size:14px; font-weight:500; margin:0; color:#6B7280;">Wireframing</p>
                                <p style="font-size:11px; color:#6B7280; margin:2px 0 0; font-style:italic;">Project Progress: 4/15/2026</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-circle-half-stroke" style="color:#3B82F6; font-size:18px;"></i>
                    </div>

                    <!-- Pending -->
                    <div class="project-row">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <i class="fa-solid fa-circle-notch fa-spin" style="color:#3B82F6; font-size:22px;"></i>
                            <div>
                                <p style="font-size:14px; font-weight:600; margin:0; color:#1a1a2e;">Development</p>
                                <p style="font-size:11px; color:#6B7280; margin:2px 0 0; font-style:italic;">End Project: 5/5/2026</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-circle" style="color:#D1D5DB; font-size:18px;"></i>
                    </div>
                </div>
            </div>

            <!-- Project Files -->
            <div class="glass" style="padding:24px;">
                <h3 style="font-size:17px; font-weight:700; margin-bottom:16px; color:#1a1a2e;">Project Files</h3>

                <div style="display:flex; flex-direction:column; gap:10px;">
                    <div class="project-row">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div class="file-icon-box" style="color:#EF4444;">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <div>
                                <p style="font-size:14px; font-weight:600; margin:0; color:#1a1a2e;">Requirements.pdf</p>
                                <p style="font-size:11px; color:#6B7280; margin:2px 0 0; font-style:italic;">Uploaded April 30, 09:32</p>
                            </div>
                        </div>
                        <p style="font-size:11px; color:#6B7280;">Apr 30, 09:32</p>
                    </div>

                    <div class="project-row">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div class="file-icon-box" style="color:#EAB308;">
                                <i class="fa-solid fa-file-zipper"></i>
                            </div>
                            <div>
                                <p style="font-size:14px; font-weight:600; margin:0; color:#1a1a2e;">Wireframe.sketch</p>
                                <p style="font-size:11px; color:#6B7280; margin:2px 0 0; font-style:italic;">Uploaded April 30, 09:32</p>
                            </div>
                        </div>
                        <p style="font-size:11px; color:#6B7280;">Apr 30, 09:32</p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Chat Support Floating -->
    <div class="chat-btn">
        <div class="chat-avatar">
            <i class="fa-solid fa-user" style="color:white; font-size:14px;"></i>
        </div>
        <span>Chat Support</span>
        <span class="new-chat-badge">+ New Chat</span>
    </div>

</body>
</html>