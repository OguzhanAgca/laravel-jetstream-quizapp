<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
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
            'user_id' => rand(2, 10),
            'question_id' => rand(1, 150),
            'answer' => $options[rand(0, 3)]
        ];
    }
}
