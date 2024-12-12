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
            $table->string('login')->unique()->nullable();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });


        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->string('code')->nullable();
            $table->enum('type', ['success', 'info', 'warning', 'danger', 'secondary'])->default('secondary');
            $table->enum('permanent', ['yes', 'no'])->default('no');
            $table->longText('message')->nullable();
            $table->timestamp('lifetime')->nullable();
            $table->timestamps();

            $table->foreign('uid')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('users_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('token', 32)->unique();
            $table->string('code')->nullable();
            $table->timestamp('lifetime')->nullable();
            $table->timestamps();

            $table->foreign('email')->references('email')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('users_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('users');
    }
};
