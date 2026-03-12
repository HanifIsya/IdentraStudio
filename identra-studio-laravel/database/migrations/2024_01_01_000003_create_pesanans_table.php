<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->increments('Pesanan_ID');
            $table->unsignedInteger('Layanan_ID');
            $table->unsignedInteger('Pembayaran_ID')->nullable();
            $table->unsignedInteger('User_ID');
            $table->text('Status');
            $table->date('Tanggal_pesanan');
            $table->decimal('Total_harga', 15, 2);
            $table->text('Keterangan')->nullable();
            $table->timestamps();

            $table->foreign('Layanan_ID')->references('Layanan_ID')->on('layanans')->onDelete('cascade');
            $table->foreign('User_ID')->references('User_ID')->on('users2')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
