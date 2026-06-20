<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropColumn('class');
        });

        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn('child_age');
            $table->date('child_birth_date')->nullable()->after('child_name');
        });
    }

    public function down(): void
    {
        Schema::table('children', function (Blueprint $table) {
            $table->enum('class', ['bunga', 'matahari', 'bintang', 'bulan'])->nullable();
        });

        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn('child_birth_date');
            $table->string('child_age');
        });
    }
};
