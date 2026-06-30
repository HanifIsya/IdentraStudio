<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // 1. TAMPILAN HALAMAN CHAT (Bisa diakses User biasa maupun Admin)
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            // PERBAIKAN: Admin melihat daftar ROOM berdasarkan transaksi/proyek yang aktif (PAID, SETTLED, PENDING)
            // Relasi user dan layanan di-load agar nama client dan nama proyek tampil di sidebar chat admin
            $chatRooms = Transaction::with(['user', 'layanan'])
                            ->whereIn('status', ['PAID', 'SETTLED', 'PENDING'])
                            ->orderBy('updated_at', 'desc')
                            ->get();

            return view('ChatAdmin', compact('chatRooms'));
        }

        // User biasa langsung diarahkan ke chatroom di dalam TrackingProject
        return view('ChatUser');
    }

    // 2. API FETCH DATA PESAN (Mengambil history chat berdasarkan ID Proyek / Room)
    public function getMessages($transactionId = null)
    {
        if (!$transactionId) {
            return response()->json([]);
        }

        // Proteksi Keamanan: Jika bukan admin, pastikan proyek ini benar-benar miliknya
        if (auth()->user()->role !== 'admin') {
            $isOwner = Transaction::where('id', $transactionId)
                                  ->where('user_id', auth()->user()->User_ID)
                                  ->exists();
            if (!$isOwner) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        // Ambil history pesan khusus untuk kamar proyek ini saja
        $messages = Message::where('transaction_id', $transactionId)
                            ->orderBy('created_at', 'asc')
                            ->get();

        return response()->json($messages);
    }

    // 3. API KIRIM PESAN (Mendukung Teks dan File Terkunci per Room Proyek)
    public function sendMessage(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|integer|exists:transactions,id', // Wajib mengikat ke ID Proyek
            'message'        => 'nullable|string',
            'file'           => 'nullable|file|mimes:jpg,jpeg,png,pdf,zip,rar,doc,docx,xls,xlsx|max:10240' // Batasan 10MB
        ]);

        $senderRole = auth()->user()->role; // Ambil role ('admin' atau 'user')
        $transactionId = $request->transaction_id;

        // Proteksi Keamanan tambahan untuk sisi client biasa
        if ($senderRole !== 'admin') {
            $isOwner = Transaction::where('id', $transactionId)
                                  ->where('user_id', auth()->user()->User_ID)
                                  ->exists();
            if (!$isOwner) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        $finalMessage = $request->message;

        // LOGIKA FILE: Cek jika request membawa file berkas lampiran
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            
            // Menyimpan berkas ke folder lokal: storage/app/public/uploads
            $path = $uploadedFile->store('uploads', 'public');
            
            // Path relatif disimpan ke database menggantikan isi pesan teks jika tidak ada teks
            $finalMessage = $path;
        }

        // Simpan baris data ke database dengan mengikat kolom transaction_id baru
        $newMessage = Message::create([
            'transaction_id' => $transactionId, // <--- Jembatan pengikat room proyek
            'user_id'        => auth()->user()->User_ID, // ID pengirim pesan saat ini
            'sender_role'    => $senderRole,
            'message'        => $finalMessage,
            'is_read'        => false
        ]);

        return response()->json(['status' => 'success', 'data' => $newMessage]);
    }
}