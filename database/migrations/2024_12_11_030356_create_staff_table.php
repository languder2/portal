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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('uid');
            $table->unsignedBigInteger('ed_faculty')->nullable();
            $table->unsignedBigInteger('ed_department')->nullable();
            $table->text('department')->nullable();
            $table->string('post')->nullable();
            $table->date('employment')->nullable();
            $table->date('dismissal')->nullable();

            $table->enum('status', ['created', 'confirmed','failed'])->default('created');

            $table->longText('comment')->nullable();
            $table->string('template')->nullable();

            /* time marks */

            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            /* */

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
