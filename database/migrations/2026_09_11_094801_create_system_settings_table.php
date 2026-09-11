<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hospital_name');
            $table->string('logo')->nullable();
            $table->integer('max_video_size_mb')->default(500);
            $table->integer('max_pdf_size_mb')->default(50);
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
