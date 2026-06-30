<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 
        'layanan_id', 
        'external_id', 
        'amount', 
        'status', 
        'progress'
    ];

    /**
     * Relasi Balik: Transaksi ini dimiliki oleh satu User tertentu
     */
    public function user()
    {
        // 'user_id' adalah nama kolom foreign key di tabel transactions Anda
        // 'User_ID' adalah primary key kustom di tabel users Anda
        return $this->belongsTo(User::class, 'user_id', 'User_ID');
    }

    /**
     * Relasi Balik: Transaksi ini memiliki/membeli satu Layanan tertentu
     */
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'Layanan_ID');
    }

    /**
     * Relasi ke model ProjectAsset
     * Satu transaksi/proyek bisa memiliki banyak berkas hasil produksi dari admin
     */
    public function assets()
    {
        return $this->hasMany(ProjectAsset::class, 'transaction_id', 'id');
    }
}