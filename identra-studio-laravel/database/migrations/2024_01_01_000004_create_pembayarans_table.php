<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            // Menggunakan id() agar sinkron dengan tabel lainnya
            $table->id('Pembayaran_ID'); 

            // WAJIB menggunakan unsignedBigInteger agar cocok dengan id() di tabel pesanans
            $table->unsignedBigInteger('Pesanan_ID');
            
            $table->text('Metode_bayar');
            $table->date('Tanggal_bayar');
            $table->boolean('Status_bayar')->default(false);
            $table->timestamps();

            // Definisi Foreign Key yang merujuk ke primary key Pesanan_ID di tabel pesanans
            $table->foreign('Pesanan_ID')
                  ->references('Pesanan_ID')
                  ->on('pesanans')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};