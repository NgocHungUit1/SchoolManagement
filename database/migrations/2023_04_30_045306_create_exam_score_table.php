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
        Schema::create('exam_score', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->nullable()->constrained('class');
            $table->foreignId('exam_id')->nullable()->constrained('exam');
            $table->foreignId('student_id')->nullable()->constrained('users');
            $table->string('score')->nullable();
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
        Schema::dropIfExists('exam_score');
    }
};
