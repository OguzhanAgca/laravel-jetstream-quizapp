<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $options = ['answer_a', 'answer_b', 'answer_c', 'answer_d'];
        return [
            'quiz_id' => rand(1, 15),
            'question' => $this->faker->sentence(rand(4, 9)),
            'answer_a' => $this->faker->sentence(rand(2, 4)),
            'answer_b' => $this->faker->sentence(rand(2, 4)),
            'answer_c' => $this->faker->sentence(rand(2, 4)),
            'answer_d' => $this->faker->sentence(rand(2, 4)),
            'correct_answer' => $options[rand(0, 3)]
        ];
    }
}
