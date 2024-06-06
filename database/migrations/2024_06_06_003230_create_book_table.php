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
        Schema::create('book', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('title');
            $table->string('author');
            $table->integer('stock')->default(0);
            $table->string('cover');
            $table->text('description')->nullable();
            $table->string('ISBN')->nullable();
            $table->string('publisher')->nullable();
            $table->string('language')->nullable()->default('Indonesia');
            $table->integer('publishing_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
