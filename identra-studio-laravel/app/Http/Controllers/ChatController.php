<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // 1. TAMPILAN HALAMAN CHAT (Bisa diakses User biasa maupun Admin)
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            // Admin melihat daftar user yang pernah mengirim pesan
            $chatUsers = User::whereHas('messages')->get();
            return view('ChatAdmin', compact('chatUsers'));
        }

        // User biasa langsung diarahkan ke chatroom miliknya sendiri
        return view('ChatUser');
    }

    // 2. API FETCH DATA PESAN (Mengambil history chat)
    public function getMessages($userId = null)
    {
        // Jika yang akses admin, ambil pesan berdasarkan ID user yang sedang dipilih admin
        // Jika yang akses user biasa, otomatis ambil ID dirinya sendiri
        $targetUserId = (auth()->user()->role === 'admin') ? $userId : auth()->user()->User_ID;

        if (!$targetUserId) {
            return response()->json([]);
        }

        $messages = Message::where('user_id', $targetUserId)
                            ->orderBy('created_at', 'asc')
                            ->get();

        return response()->json($messages);
    }

    // 3. API KIRIM PESAN
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'user_id' => 'nullable|integer' // Diisi oleh admin untuk menentukan target user
        ]);

        $senderRole = auth()->user()->role; // Ambil role yang sedang login ('admin' atau 'user')
        
        // Tentukan ruangan chat ini milik siapa
        $chatRoomOwner = ($senderRole === 'admin') ? $request->user_id : auth()->user()->User_ID;

        $newMessage = Message::create([
            'user_id'     => $chatRoomOwner,
            'sender_role' => $senderRole,
            'message'     => $request->message,
            'is_read'     => false
        ]);

        return response()->json(['status' => 'success', 'data' => $newMessage]);
    }
}