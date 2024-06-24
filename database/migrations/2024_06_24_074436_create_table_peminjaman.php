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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id')->primary();
            $table->foreignId('book_id')->constrained('book')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('user')->onUpdate('cascade')->onDelete('cascade');
            // status : requested, borrowed, declined, returned, vanished, confirmed,
            $table->string('status', 30)->default('requested');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
