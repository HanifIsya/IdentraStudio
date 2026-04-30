<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id('Layanan_ID');
            $table->string('nama_layanan');
            $table->string('tagline'); // Kolom yang sebelumnya hilang
            $table->string('ikon');
            $table->json('fitur'); // Disimpan sebagai JSON agar dinamis
            $table->string('harga');
            $table->boolean('is_highlight')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('layanans');
    }
};