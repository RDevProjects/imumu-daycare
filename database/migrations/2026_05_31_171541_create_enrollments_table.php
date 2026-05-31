<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique(); // REG-YYYYMMDD-XXX
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->string('parent_email')->nullable();
            $table->string('child_name');
            $table->string('child_age');
            $table->enum('child_gender', ['L', 'P'])->nullable();
            $table->text('address')->nullable();
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->enum('payment_method', ['cash', 'transfer']);
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'paid', 'rejected', 'cancelled'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('confirmed_at')->nullable();
            $table->string('history_token')->unique(); // for parent history link
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
