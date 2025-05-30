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
        Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->string('member_id')->unique()->comment('NIM/NIS');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone');
        $table->enum('type', ['siswa', 'mahasiswa', 'guru', 'staff', 'umum']);
        $table->text('address');
        $table->date('join_date');
        $table->softDeletes();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
