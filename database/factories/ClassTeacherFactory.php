<?php

namespace Database\Factories;

use App\Models\ClassModel;
use App\Models\ClassTeacher;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassTeacher>
 */
class ClassTeacherFactory extends Factory
{
    protected $model = ClassTeacher::class;
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
            'teacher_id' => function () {
                return User::factory()->create(['user_type' => 2])->id;
            },
            'is_delete' => $this->faker->boolean(10),
            'status' => $this->faker->randomElement([0, 1]),
            'created_by' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
