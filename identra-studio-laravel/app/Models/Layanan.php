<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model {
    protected $primaryKey = 'Layanan_ID';
    protected $fillable = [
        'nama_layanan', 'tagline', 'ikon', 'fitur', 'harga', 'is_highlight'
    ];

    // Mengonversi JSON fitur menjadi Array secara otomatis
    protected $casts = [
        'fitur' => 'array',
    ];
}