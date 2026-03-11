<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\Pembayaran;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Users
        $user = User::create([
            'Email'    => 'admin@identrastudio.com',
            'Nama'     => 'Admin Studio',
            'Password' => Hash::make('password'),
        ]);

        // Seed Layanans
        $layanans = [
            ['Nama_layanan' => 'Desain Logo',        'Kategori' => 'Desain Grafis'],
            ['Nama_layanan' => 'Pembuatan Website',  'Kategori' => 'Web Development'],
            ['Nama_layanan' => 'Foto Produk',        'Kategori' => 'Fotografi'],
            ['Nama_layanan' => 'Editing Video',      'Kategori' => 'Videografi'],
        ];

        foreach ($layanans as $l) {
            Layanan::create($l);
        }

        // Seed Pesanan
        $pesanan = Pesanan::create([
            'Layanan_ID'      => 1,
            'User_ID'         => $user->User_ID,
            'Status'          => 'Menunggu',
            'Tanggal_pesanan' => now()->toDateString(),
            'Total_harga'     => 500000,
            'Keterangan'      => 'Logo untuk brand baru',
        ]);

        // Seed Pembayaran
        $pembayaran = Pembayaran::create([
            'Pesanan_ID'    => $pesanan->Pesanan_ID,
            'Metode_bayar'  => 'Transfer Bank',
            'Tanggal_bayar' => now()->toDateString(),
            'Status_bayar'  => false,
        ]);

        $pesanan->update(['Pembayaran_ID' => $pembayaran->Pembayaran_ID]);
    }
}
