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
        Schema::table('book_category', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained(
                table: 'book',
                indexName: 'book_category_book_id'
            )->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained(
                table: 'category',
                indexName: 'book_category_category_id'
            )->nullable()->constrained()->cascadeOnDelete();

            $table->dropColumn(['id_book', 'id_category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_category', function (Blueprint $table) {
            $table->unsignedBigInteger('id_book');
            $table->unsignedBigInteger('id_category');
            $table->dropColumn(['book_id', 'category_id']);
        });
    }
};
