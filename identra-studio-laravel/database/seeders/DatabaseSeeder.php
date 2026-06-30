<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Jalankan Seeder Layanan asli kamu yang aman dan sesuai Figma
        $this->call(LayananSeeder::class);

        // 2. Buat Akun User yang bersih
        $user = User::create([
            'Nama' => 'Hanif Isya',
            'Email' => 'hanif@identra.com',
            'Password' => Hash::make('password123'),
        ]);

        // 3. Buat data tracking REAL untuk demo (Status PAID, Progress 70%)
        // Transaction::create([
        //     'user_id'     => $user->User_ID,
        //     'external_id' => 'IDENTRA-' . time(),
        //     'amount'      => 5000000,
        //     'status'      => 'PAID',
        //     'layanan_id' => 1, 
        //     'progress'    => 70, 
        // ]);
    }
}