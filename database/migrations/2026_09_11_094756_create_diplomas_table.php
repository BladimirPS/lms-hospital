<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diplomas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->unique()->constrained('enrollments');
            $table->foreignId('attempt_id')->constrained('exam_attempts');
            $table->string('diploma_code', 50)->unique();
            $table->string('manager_name');
            $table->decimal('obtained_score', 5, 2);
            $table->date('issued_at');
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diplomas');
    }
};
