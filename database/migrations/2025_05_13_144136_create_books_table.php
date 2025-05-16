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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');           // Judul buku (Inggris)
            $table->string('author');          // Pengarang (Inggris)
            $table->string('publisher');       // Penerbit (Inggris)
            $table->integer('year');           // Tahun terbit (Inggris)
            $table->string('isbn')->unique();  // ISBN (Inggris)
            $table->integer('stock')->default(0); // Stok (Inggris)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
