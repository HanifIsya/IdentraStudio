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
    Schema::create('project_assets', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('transaction_id'); // Mengikat asset ke project/transaksi spesifik
        $table->string('file_name');
        $table->string('file_path');
        $table->string('file_size')->nullable();
        $table->timestamps();

        // Foreign key ke tabel transactions
        $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_assets');
    }
};
