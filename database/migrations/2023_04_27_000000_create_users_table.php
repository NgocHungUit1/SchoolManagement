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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->tinyInteger('user_type')->nullable();
            $table->tinyInteger('is_delete')->nullable()->default(0);
            $table->string('admission_number')->unique()->nullable();
            $table->string('roll_number')->nullable();
            $table->foreignId('class_id')->nullable()->constrained('class');
            $table->date('date_of_birth')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('qualification')->nullable();
            $table->string('experience')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('user_avatar')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->string('teacher_id')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
