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
}