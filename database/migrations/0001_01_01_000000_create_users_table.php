<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('block')->default(0);

            $table->string('status')->default('active');
            $table->string('access_type')->default('User');
            $table->boolean('is_approved')->default(0);
            $table->datetime('approved_at')->nullable();
            $table->string('require_password_reset')->default('no');
            $table->string('is_expire')->default('no');
            $table->datetime('expire_date')->nullable();

            $table->bigInteger('invited_by')->nullable();
            $table->datetime('invited_date')->nullable();

            $table->boolean('accepted')->default(0);
            $table->datetime('accepted_date')->nullable();
            $table->boolean('is_online')->default(0);
            $table->datetime('login_at')->nullable();
            $table->datetime('logout_at')->nullable();
            $table->string('slug')->index();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
