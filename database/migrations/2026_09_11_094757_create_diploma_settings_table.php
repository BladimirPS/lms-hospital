<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diploma_settings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('signature_mode')->default(3);
            $table->string('director_signature')->nullable();
            $table->string('hr_signature')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diploma_settings');
    }
};
