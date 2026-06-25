<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ChatController extends Controller
{
    // Tampilan halaman chat untuk User
    public function index()
    {
        return view('chat');
    }

    // Mengambil semua pesan via API JavaScript (Fetch)
    public function getMessages($userId = null)
    {
        // Jika user biasa, ambil chat milik dirinya sendiri. Jika admin, ambil berdasarkan ID user yang sedang di-chat
        $id = auth()->user()->role === 'admin' ? $userId : auth()->user()->id;

        $messages = Message::where('user_id', $id)->orderBy('created_at', 'asc')->get();
        return response()->json($messages);
    }

    // Menyimpan pesan baru dari form chat
    public function sendMessage(Request $request)
    {
        $request->validate(['message' => 'required']);

        // Menentukan user_id target
        $userId = auth()->user()->role === 'admin' ? $request->input('user_id') : auth()->user()->id;

        $chat = Message::create([
            'user_id' => $userId,
            'sender_role' => auth()->user()->role === 'admin' ? 'admin' : 'user',
            'message' => $request->input('message'),
        ]);

        return response()->json(['success' => true, 'chat' => $chat]);
    }
}