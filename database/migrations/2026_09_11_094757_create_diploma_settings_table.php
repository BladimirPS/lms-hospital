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
            $table->string('hospital_name')->default('Hospital Regional de Occidente');
            $table->string('director_name')->nullable();
            $table->string('director_title')->default('Director Ejecutivo');
            $table->string('director_signature')->nullable();
            $table->string('hr_name')->nullable();
            $table->string('hr_title')->default('Coordinador/a de Recursos Humanos');
            $table->string('hr_signature')->nullable();
            $table->string('signature_mode')->default('both');
            $table->string('logo_path')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diploma_settings');
    }
};
