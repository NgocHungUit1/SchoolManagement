<?php

namespace Database\Factories;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassSubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClassSubject::class;

    /**
     * Define the model's default state.
     *
     * @return array
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
            'is_delete' => $this->faker->boolean(10),
            'status' => $this->faker->randomElement([0, 1]),
            'created_by' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
