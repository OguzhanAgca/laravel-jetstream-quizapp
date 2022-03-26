<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $quiz_title = $this->faker->sentence(rand(3, 6));
        return [
            'quiz_title' => $quiz_title,
            'quiz_slug' => Str::slug($quiz_title),
            'quiz_description' => $this->faker->sentence(rand(4, 7))
        ];
    }
}
