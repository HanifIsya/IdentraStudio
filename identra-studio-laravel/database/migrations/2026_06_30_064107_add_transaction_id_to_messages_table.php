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
    Schema::table('messages', function (Blueprint $table) {
        // Menyisipkan kolom transaction_id setelah user_id atau di baris baru
        $table->unsignedBigInteger('transaction_id')->nullable()->after('id');

        // Opsional: Buat foreign key jembatan ke tabel transaksi Anda
        $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('messages', function (Blueprint $table) {
        $table->dropForeign(['transaction_id']);
        $table->dropColumn('transaction_id');
    });
}
};
