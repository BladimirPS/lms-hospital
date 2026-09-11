<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('type', ['talk', 'workshop']);
            $table->integer('version')->default(1);
            $table->foreignId('parent_version_id')->nullable()->constrained('courses');
            $table->boolean('is_free_choice')->default(false);
            $table->boolean('generates_diploma')->default(false);
            $table->integer('minimum_score')->default(70);
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->foreignId('creator_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
