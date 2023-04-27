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
        Schema::create('class_subject_timetable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->nullable()->constrained('class');
            $table->foreignId('subject_id')->nullable()->constrained('subject');
            $table->foreignId('day_id')->nullable()->constrained('day_of_week');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('room_number')->nullable();
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
        Schema::dropIfExists('class_subject_timetable');
    }
};
