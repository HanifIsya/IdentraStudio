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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            
            // 1. Kolom Foreign Key Relasi
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('layanan_id'); // <--- TAMBAHKAN KOLOM INI
            
            $table->string('external_id')->unique();
            $table->decimal('amount', 12, 2);
            $table->string('status')->default('PENDING');
            $table->integer('progress')->default(0);
            $table->timestamps();

            // 2. Deklarasi Aturan Hubungan Antar Tabel (Foreign Key Constraints)
            // Hubungkan ke 'User_ID' di tabel 'users'
            $table->foreign('user_id')->references('User_ID')->on('users')->onDelete('cascade');
            
            // Hubungkan ke 'Layanan_ID' di tabel 'layanan' (Pastikan nama tabel di database Anda 'layanans' atau 'layanan')
            $table->foreign('layanan_id')->references('Layanan_ID')->on('layanans')->onDelete('cascade'); // <--- TAMBAHKAN BARIS INI
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};