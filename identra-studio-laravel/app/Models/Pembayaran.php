<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $primaryKey = 'Pembayaran_ID';

    protected $fillable = [
        'Pesanan_ID',
        'Metode_bayar',
        'Tanggal_bayar',
        'Status_bayar',
    ];

    protected $casts = [
        'Tanggal_bayar' => 'date',
        'Status_bayar'  => 'boolean',
    ];

    // Relasi: Pembayaran milik Pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'Pesanan_ID', 'Pesanan_ID');
    }
}
