<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->unique()->constrained()->onDelete('cascade');
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->enum('class', ['bunga', 'matahari', 'bintang', 'bulan'])->nullable();
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->text('allergies')->nullable();
            $table->enum('status', ['aktif', 'cuti', 'sakit', 'pindah', 'lulus'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
