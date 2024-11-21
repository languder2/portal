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
        Schema::create('moodles', function (Blueprint $table) {
            $table->id();
            $table->integer('mid');
            $table->string('email');
            $table->integer('last_access')->nullable();
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
        Schema::dropIfExists('moodles');
    }
};
