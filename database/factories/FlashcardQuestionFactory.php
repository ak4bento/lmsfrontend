<?php

namespace Database\Factories;

use App\Models\FlashcardQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlashcardQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FlashcardQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'flashcard_categories_id' => $this->faker->randomDigitNotNull,
        'question' => $this->faker->word,
        'images' => $this->faker->word,
        'explanation' => $this->faker->word,
        'images_explanation' => $this->faker->word,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
