<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_score', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->nullable()->constrained('class');
            $table->foreignId('subject_id')->nullable()->constrained('subject');
            $table->foreignId('student_id')->nullable()->constrained('users');
            $table->foreignId('semester_id')->nullable()->constrained('semester');
            $table->string('score')->nullable();
            $table->string('avage_score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_score');
    }
};
