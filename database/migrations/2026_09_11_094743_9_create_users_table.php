<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('system_code', 50)->unique()->comment('Código del sistema');

            $table->string('hospital_code', 50)->nullable()->comment('Código de empleado / Número de contrato');
            $table->string('dpi', 20)->nullable()->comment('DPI');

            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('third_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('second_last_name', 100)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('budget_line_id')->nullable()->constrained('budget_lines');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('signature_image')->nullable();
            $table->date('hire_date')->nullable();
            $table->foreignId('position_id')->nullable()->constrained('positions');
            $table->string('phone', 20)->nullable();
            $table->foreignId('section_id')->nullable()->constrained('sections');
            $table->boolean('active')->default(true);
            $table->string('invitation_token')->nullable();
            $table->timestamp('invitation_sent_at')->nullable();
            $table->timestamp('last_access_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
            Schema::dropIfExists('password_reset_tokens');

    }
};
