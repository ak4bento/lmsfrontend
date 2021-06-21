<?php

namespace Database\Factories;

use App\Models\FlashcardCategories;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlashcardCategoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FlashcardCategories::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => $this->faker->randomDigitNotNull,
        'second_parent_id' => $this->faker->text,
        'third_parent_id' => $this->faker->text,
        'level' => $this->faker->randomDigitNotNull,
        'category' => $this->faker->word,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
