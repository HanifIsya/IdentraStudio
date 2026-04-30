<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        // Data Layanan sesuai Desain Figma Identra Studio
        $data = [
            [
                'nama_layanan' => 'Website Design',
                'tagline'      => 'Create your own website',
                'ikon'         => 'fa-desktop',
                'fitur'        => ['Konsultasi kebutuhan website', 'Desain UI/UX website', 'Desain halaman utama (Homepage)', 'Desain halaman tambahan', 'Responsive design', 'Revisi desain (2-3 kali)'],
                'harga'        => '$240',
                'is_highlight' => true // Kartu warna putih
            ],
            [
                'nama_layanan' => 'Logo Creation',
                'tagline'      => 'Design a custom logo',
                'ikon'         => 'fa-pen-nib',
                'fitur'        => ['Konsultasi konsep logo', 'Pembuatan pilihan logo', 'Revisi desain logo', 'File logo (PNG, JPG, SVG)', 'Versi warna & hitam putih', 'Panduan penggunaan logo'],
                'harga'        => '$100',
                'is_highlight' => false
            ],
            [
                'nama_layanan' => 'App Development',
                'tagline'      => 'Build a mobile app',
                'ikon'         => 'fa-mobile-screen',
                'fitur'        => ['Analisis kebutuhan aplikasi', 'Desain UI/UX aplikasi', 'Pengembangan aplikasi', 'Integrasi database', 'Testing aplikasi', 'Maintenance / perbaikan bug'],
                'harga'        => '$158',
                'is_highlight' => false
            ],
            [
                'nama_layanan' => 'Graphic Design',
                'tagline'      => 'Get creative visuals',
                'ikon'         => 'fa-palette',
                'fitur'        => ['Desain poster', 'Desain banner / spanduk', 'Desain konten media sosial', 'Desain brosur / flyer', 'Revisi desain', 'File desain siap cetak'],
                'harga'        => '$124',
                'is_highlight' => false
            ],
            [
                'nama_layanan' => 'Premium Pack',
                'tagline'      => 'Film Production',
                'ikon'         => 'fa-video',
                'fitur'        => ['Konsultasi konsep film', 'Editing cinematic', 'Color grading', 'Musik & sound effect', 'Revisi 2-3 kali', 'Storyboard video'],
                'harga'        => '$123',
                'is_highlight' => false
            ],
            [
                'nama_layanan' => 'Basic Pack Film',
                'tagline'      => 'Full HD output',
                'ikon'         => 'fa-camera-retro',
                'fitur'        => ['Shooting video dasar', 'Editing video', 'Penambahan musik background', 'Color correction', 'File video final HD'],
                'harga'        => '$115',
                'is_highlight' => false
            ],
        ];

        foreach ($data as $item) {
            Layanan::create($item);
        }
    }
}