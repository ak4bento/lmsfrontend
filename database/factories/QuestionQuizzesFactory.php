<?php

namespace Database\Factories;

use App\Models\QuestionQuizzes;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionQuizzesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionQuizzes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quizzes_id' => $this->faker->randomDigitNotNull,
        'question_id' => $this->faker->randomDigitNotNull,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
