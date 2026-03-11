<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $primaryKey = 'Pesanan_ID';

    protected $fillable = [
        'Layanan_ID',
        'Pembayaran_ID',
        'User_ID',
        'Status',
        'Tanggal_pesanan',
        'Total_harga',
        'Keterangan',
    ];

    protected $casts = [
        'Tanggal_pesanan' => 'date',
        'Total_harga'     => 'decimal:2',
    ];

    // Relasi: Pesanan milik User
    public function user()
    {
        return $this->belongsTo(User::class, 'User_ID', 'User_ID');
    }

    // Relasi: Pesanan milik Layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'Layanan_ID', 'Layanan_ID');
    }

    // Relasi: Pesanan memiliki satu Pembayaran
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'Pesanan_ID', 'Pesanan_ID');
    }
}
