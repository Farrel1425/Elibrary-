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
        Schema::create('loans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('member_id')->constrained('members'); // Relasi ke member
        $table->foreignId('book_id')->constrained('books');     // Relasi ke buku
        $table->foreignId('librarian_id')->constrained('users'); // Petugas yang memproses
        $table->date('loan_date');
        $table->date('due_date');
        $table->date('return_date')->nullable(); // Diisi saat buku dikembalikan
        $table->integer('fine')->default(0); // Denda jika terlambat
        $table->string('status')->default('borrowed'); // borrowed, returned, overdue
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
