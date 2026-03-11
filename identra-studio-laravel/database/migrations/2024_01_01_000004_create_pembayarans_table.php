<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->increments('Pembayaran_ID');
            $table->unsignedInteger('Pesanan_ID');
            $table->text('Metode_bayar');
            $table->date('Tanggal_bayar');
            $table->boolean('Status_bayar')->default(false);
            $table->timestamps();

            $table->foreign('Pesanan_ID')->references('Pesanan_ID')->on('pesanans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
