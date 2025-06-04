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
            $table->id()->index();
            $table->string('username')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('first_name')->nullable()->index();
            $table->string('last_name')->nullable()->index();
            $table->string('mobile',32)->nullable()->index();
            $table->string('phone',32)->nullable()->index();
            $table->string('gender',8)->nullable()->index();
            $table->dateTime('birth_date')->nullable()->index();
            $table->string('birth_place')->nullable()->index();
            $table->string('address',1024)->nullable();
            $table->string('type', 32)->nullable();
            $table->boolean('is_admin')->default(0);
            $table->string('api_token')->nullable()->index();
            $table->string('picture')->nullable();
            $table->string('status',32)->nullable()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
