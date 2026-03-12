<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users2', function (Blueprint $table) {
            $table->increments('User_ID');
            $table->string('Email', 50)->unique();
            $table->string('Nama', 50);
            $table->string('Password', 12);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users2');
    }
};
