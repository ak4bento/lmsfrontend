<?php

namespace Database\Factories;

use App\Models\FlashcardCategoriesQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlashcardCategoriesQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FlashcardCategoriesQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'flashcard_questions_id' => $this->faker->randomDigitNotNull,
        'flashcard_categories_id' => $this->faker->randomDigitNotNull,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
