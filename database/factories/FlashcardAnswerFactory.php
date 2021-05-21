<?php

namespace Database\Factories;

use App\Models\FlashcardAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlashcardAnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FlashcardAnswer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomDigitNotNull,
        'flashcard_questions_id' => $this->faker->randomDigitNotNull,
        'group' => $this->faker->word,
        'choice' => $this->faker->word,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
