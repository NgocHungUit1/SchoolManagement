<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'user_type' => fake()->numberBetween(1, 3),
            'is_delete' => fake()->numberBetween(0, 1),
            'admission_number' => fake()->unique()->randomNumber(),
            'roll_number' => fake()->randomNumber(),
            'class_id' => NULL, // Bạn có thể thay đổi giá trị mặc định này tùy theo nhu cầu sử dụng của bạn
            'date_of_birth' => fake()->date(),
            'joining_date' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female']),
            'qualification' => fake()->jobTitle(),
            'experience' => fake()->sentence(),
            'address' => fake()->address(),
            'mobile_number' => fake()->phoneNumber(),
            'user_avatar' => NULL, // Bạn có thể thay đổi giá trị mặc định này tùy theo nhu cầu sử dụng của bạn
            'status' => fake()->numberBetween(0, 1),
            'teacher_id' => fake()->unique()->randomNumber(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
