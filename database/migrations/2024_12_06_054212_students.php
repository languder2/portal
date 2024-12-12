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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->unsignedBigInteger('faculty')->nullable();
            $table->unsignedBigInteger('department')->nullable();
            $table->unsignedBigInteger('level')->nullable();
            $table->unsignedBigInteger('form')->nullable();
            $table->unsignedBigInteger('speciality')->nullable();
            $table->integer('course')->nullable();
            $table->string('group_number')->nullable();
            $table->string('contract_number')->nullable();
            $table->year('year_from')->nullable();
            $table->year('year_to')->nullable();

            $table->enum('status', ['created', 'confirmed','failed'])->default('created');

            $table->longText('comment')->nullable();

            $table->string('template')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->foreign('faculty')->references('id')->on('ed_faculties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('department')->references('id')->on('ed_departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('level')->references('id')->on('ed_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('form')->references('id')->on('ed_forms')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('speciality')->references('id')->on('ed_specialities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
