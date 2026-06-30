<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Management - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            color: #9ca3af;
            transition: all 0.2s;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
        }
        .nav-link.active {
            background-color: rgba(147, 51, 234, 0.1);
            border-left: 4px solid #a855f7;
            color: #c084fc;
            font-weight: bold;
        }
        .nav-link i {
            width: 1.25rem;
            text-align: center;
        }
    </style>
</head>
<body class="bg-[#0b0a14] text-white font-sans min-h-screen flex">

    <aside class="w-64 bg-[#11101e] border-r border-white/10 p-6 flex flex-col min-h-screen flex-shrink-0">
        <div class="mb-8 px-2">
            <h1 class="text-xl font-black bg-gradient-to-r from-purple-400 to-indigo-400 bg-clip-text text-transparent tracking-wider">
                IDENTRA <span class="text-white text-xs font-light block tracking-normal text-gray-400">Admin Workspace</span>
            </h1>
        </div>

        <nav class="flex-grow space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fa-solid fa-chart-line"></i><span>Dashboard</span>
            </a>
            <a href="#" class="nav-link"><i class="fa-solid fa-users-gear"></i><span>User Management</span></a>
            <a href="{{ route('admin.layanan.index') }}" class="nav-link">
                <i class="fa-solid fa-boxes-packing"></i><span>Layanan</span>
            </a>
            
            <a href="{{ route('admin.transaction.index') }}" class="nav-link active">
                <i class="fa-solid fa-file-invoice-dollar"></i><span>Transaksi</span>
            </a>
            
            <a href="#" class="nav-link"><i class="fa-solid fa-briefcase"></i><span>Project Client</span></a>
            <a href="{{ route('admin.asset.index') }}" class="nav-link">
                <i class="fa-solid fa-folder-open"></i><span>File & Asset</span>
            </a>
            <a href="{{ route('chat.index') }}" class="nav-link">
                <i class="fa-solid fa-comments"></i><span>Chat Support</span>
            </a>
        </nav>

        <div class="border-t border-white/10 pt-4 mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left nav-link text-red-400 hover:bg-red-500/10 hover:text-red-300">
                    <i class="fa-solid fa-right-from-bracket"></i><span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-grow p-8 overflow-y-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Transaction Management</h1>
                <p class="text-xs text-gray-400">Pantau seluruh invoice pembayaran lunas dari customer Identra Studio</p>
            </div>
        </div>

        @if($transactions->isEmpty())
            <div class="bg-white/5 border border-white/10 rounded-2xl p-12 text-center max-w-md mx-auto my-12 shadow-xl">
                <div class="w-16 h-16 bg-purple-600/20 text-purple-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
                <h3 class="text-sm font-bold mb-1">Belum Ada Transaksi Masuk</h3>
                <p class="text-xs text-gray-400">Belum ada invoice lunas yang diterbitkan oleh sistem keuangan saat ini.</p>
            </div>
        @else
            <div class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden shadow-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-white/[0.03] border-b border-white/10 text-gray-400 font-bold uppercase tracking-wider">
                                <th class="p-4">No. Invoice</th>
                                <th class="p-4">Customer</th>
                                <th class="p-4">Layanan / Paket</th>
                                <th class="p-4">Tanggal Pembayaran</th>
                                <th class="p-4">Total Pendapatan</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($transactions as $trx)
                                <tr class="hover:bg-white/[0.01] transition-all">
                                    <td class="p-4 font-mono font-bold text-purple-400">
                                        #INV-{{ str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-white">{{ $trx->user->Nama ?? 'Client Resmi' }}</div>
                                        <div class="text-[10px] text-gray-400 mt-0.5">{{ $trx->user->Email ?? '-' }}</div>
                                    </td>
                                    <td class="p-4 font-medium text-gray-200">
                                        {{ $trx->layanan->Nama_Layanan ?? $trx->layanan->nama_layanan ?? 'Custom Project' }}
                                    </td>
                                    <td class="p-4 text-gray-400">
                                        {{ \Carbon\Carbon::parse($trx->updated_at)->translatedFormat('d F Y H:i') }} WIB
                                    </td>
                                    <td class="p-4 font-bold text-emerald-400">
                                        Rp {{ number_format($trx->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4">
                                        <span class="text-[10px] bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 px-2 py-0.5 rounded font-bold uppercase">
                                            {{ $trx->status }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="{{ route('admin.transaction.download-invoice', $trx->id) }}" 
                                           class="inline-flex items-center gap-1 bg-purple-600 hover:bg-purple-700 text-white font-bold px-3 py-1.5 rounded-lg transition-all text-[11px]">
                                            <i class="fa-solid fa-file-pdf"></i> PDF
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </main>

</body>
</html>