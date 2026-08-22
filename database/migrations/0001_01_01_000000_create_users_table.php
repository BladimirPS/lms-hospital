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
            $table->string('system_code', 50)->unique();
            $table->string('hospital_code', 50)->nullable();
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('third_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('second_last_name', 100)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('signature_image')->nullable();
            $table->date('hire_date')->nullable();
            $table->string('position', 150)->nullable();
            $table->string('phone', 20)->nullable();
            $table->foreignId('section_id')->nullable()->constrained('sections');
            $table->boolean('active')->default(true);
            $table->string('invitation_token')->nullable();
            $table->timestamp('invitation_sent_at')->nullable();
            $table->timestamp('last_access_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index('section_id', 'idx_users_section');
            $table->index('email', 'idx_users_email');
            $table->index('system_code', 'idx_users_system_code');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
