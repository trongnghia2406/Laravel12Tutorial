<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Tạo tên ngẫu nhiên
            'email' => fake()->unique()->safeEmail(), // Tạo email ngẫu nhiên
            'age' => fake()->numberBetween(18, 30), // Tuổi từ 18-30
            'class_name' => 'DH22DTC',
        ];
    }
}
