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
        Schema::create('ed_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort')->default(1000);
            $table->timestamps();
        });

        Schema::create('ed_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort')->default(1000);
            $table->timestamps();
        });

        Schema::create('ed_faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort')->default(1000);
            $table->timestamps();
        });

        Schema::create('ed_departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('faculty');
            $table->integer('sort')->default(1000);
            $table->timestamps();

            $table->foreign('faculty')->references('id')->on('ed_faculties')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('ed_specialities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->unsignedBigInteger('faculty');
            $table->unsignedBigInteger('department');
            $table->unsignedBigInteger('level');
            $table->integer('sort')->default(1000);
            $table->timestamps();

            $table->foreign('faculty')->references('id')->on('ed_faculties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('department')->references('id')->on('ed_departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('level')->references('id')->on('ed_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ed_specialities');
        Schema::dropIfExists('ed_departments');
        Schema::dropIfExists('ed_faculties');
        Schema::dropIfExists('ed_levels');
        Schema::dropIfExists('ed_forms');
    }
};
