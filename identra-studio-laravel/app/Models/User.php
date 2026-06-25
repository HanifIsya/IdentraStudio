<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // Menentukan primary key karena kamu tidak memakai 'id' default
    protected $primaryKey = 'User_ID';

    protected $fillable = [
        'Email',
        'Nama',
        'Password',
        'role',
    ];

    protected $hidden = [
        'Password',
    ];

   
    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Relasi: User memiliki banyak Pesanan
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'User_ID', 'User_ID');
    }

    /**
     * PERBAIKAN: Relasi ke model Message
     * Menghubungkan user dengan kumpulan riwayat chat miliknya
     */
    public function messages()
    {
        // 'user_id' merupakan foreign key di tabel messages
        // 'User_ID' merupakan primary key kustom di tabel users Anda
        return $this->hasMany(\App\Models\Message::class, 'user_id', 'User_ID');
    }
}