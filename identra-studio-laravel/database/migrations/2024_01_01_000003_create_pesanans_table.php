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
        Schema::create('pesanans', function (Blueprint $table) {
            // Menggunakan Big Integer sebagai Primary Key
            $table->id('Pesanan_ID'); 

            // Foreign Key WAJIB menggunakan Unsigned Big Integer agar sinkron dengan id()
            $table->unsignedBigInteger('Layanan_ID');
            $table->unsignedBigInteger('User_ID');
            
            $table->unsignedInteger('Pembayaran_ID')->nullable();
            $table->text('Status');
            $table->date('Tanggal_pesanan');
            $table->decimal('Total_harga', 15, 2);
            $table->text('Keterangan')->nullable();
            $table->timestamps();

            // Menghubungkan ke tabel layanans
            $table->foreign('Layanan_ID')
                  ->references('Layanan_ID')
                  ->on('layanans')
                  ->onDelete('cascade');

            // Menghubungkan ke tabel users (pastikan nama tabelnya 'users')
            $table->foreign('User_ID')
                  ->references('User_ID')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};