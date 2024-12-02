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
        Schema::create('users_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->string('snils')->nullable();
            $table->string('phone')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document_serial')->nullable();
            $table->string('document_number')->nullable();
            $table->string('document_issue_date')->nullable();
            $table->string('document_issue_whom')->nullable();
            $table->string('document_issue_whom_code')->nullable();
            $table->string('address')->nullable();
            $table->string('residence_address')->nullable();
            $table->string('inn')->nullable();
            $table->enum('sex',['man','woman'])->nullable();
            $table->date('birthday')->nullable();
            $table->string('citizenship')->nullable();
            $table->timestamps();

            $table->foreign('uid')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_details');
    }
};
