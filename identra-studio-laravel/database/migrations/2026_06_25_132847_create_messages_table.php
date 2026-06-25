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
    Schema::create('messages', function (Blueprint $table) {
        $table->id();
        
        // Kita definisikan kolomnya secara manual agar tipenya sinkron dengan User_ID (Big Integer)
        $table->unsignedBigInteger('user_id'); 
        
        $table->string('sender_role'); // 'user' atau 'admin'
        $table->text('message');
        $table->boolean('is_read')->default(false);
        $table->timestamps();

        // Hubungkan foreign key ke kolom 'User_ID' di tabel 'users'
        $table->foreign('user_id')->references('User_ID')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
