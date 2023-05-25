<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassSubjectTimeTable;
use App\Models\ClassTeacher;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\User;
use App\Models\Week;
use Database\Factories\DayFactory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->has(ClassModel::factory()->count(3))
            ->create();

        User::factory()
            ->has(Subject::factory()->count(3))
            ->create();
        User::factory()
            ->has(Exam::factory()->count(3))
            ->create();

        ClassSubject::factory()->count(3)->create();

        ClassTeacher::factory()->count(3)->create();

        ClassSubjectTimeTable::factory()->count(3)->create();
    }
}
