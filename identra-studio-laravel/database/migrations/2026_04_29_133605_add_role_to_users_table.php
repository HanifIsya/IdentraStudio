<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void {
    Schema::table('users', function (Blueprint $table) {
        // Kita beri default 'user' agar pendaftar baru otomatis menjadi user biasa
        $table->string('role')->default('user')->after('Email'); 
    });
}

public function down(): void {
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
    });
}

};
