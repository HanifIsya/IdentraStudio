<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model {
    protected $primaryKey = 'Layanan_ID';
    protected $fillable = [
        'nama_layanan', 'tagline', 'ikon', 'fitur', 'harga', 'is_highlight'
    ];

    protected $casts = [
        'fitur' => 'array',
    ];
}