<?php

namespace Database\Factories;

use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\Week;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassSubjectTimeTable>
 */
class ClassSubjectTimeTableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'class_id' => function () {
                return ClassModel::factory()->create()->id;
            },
            'subject_id' => function () {
                return Subject::factory()->create()->id;
            },
            'day_id' => function () {
                return Week::factory()->create()->id;
            },
            'room_number' => fake()->randomNumber(),
            'start_time' => fake()->time('H:i'),
            'end_time' => fake()->time('H:i'),
            'start_date' => fake()->date(),
            'end_date' => fake()->date()

        ];
    }
}
