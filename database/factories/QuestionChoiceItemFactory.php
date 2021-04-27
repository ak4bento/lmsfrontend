<?php

namespace Database\Factories;

use App\Models\QuestionChoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionChoiceItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionChoiceItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question_id' => $this->faker->randomDigitNotNull,
        'choice_text' => $this->faker->word,
        'is_correct' => $this->faker->word,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
