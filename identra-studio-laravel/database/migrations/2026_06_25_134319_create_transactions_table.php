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
        
        // Sesuaikan dengan User_ID
        $table->unsignedBigInteger('user_id');
        
        $table->string('external_id')->unique();
        $table->decimal('amount', 12, 2);
        $table->string('status')->default('PENDING');
        $table->integer('progress')->default(0);
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
        Schema::dropIfExists('transactions');
    }
};
