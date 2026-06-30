<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'transaction_id',
        'user_id', 
        'sender_role', // Berisi string: 'user' atau 'admin'
        'message', 
        'is_read'
    ];

    // Hubungkan pesan ke akun User pemilik ruang chat
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'User_ID');
    }
}