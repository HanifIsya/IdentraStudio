<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $primaryKey = 'Layanan_ID';

    protected $fillable = [
        'Nama_layanan',
        'Kategori',
    ];

    // Relasi: Layanan memiliki banyak Pesanan
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'Layanan_ID', 'Layanan_ID');
    }
}
