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
        Schema::table('category', function(Blueprint $table) {
            $table->id();
            $table->string('category');
        });

        Schema::table('book_category', function(Blueprint $table) {
            $table->unsignedBigInteger('id_book');
            $table->unsignedBigInteger('id_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
        Schema::dropIfExists('book_category');
    }
};
