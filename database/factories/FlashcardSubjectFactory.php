<?php

namespace Database\Factories;

use App\Models\FlashcardSubject;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlashcardSubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FlashcardSubject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->word,
        'subject_type' => $this->faker->word,
        'reference' => $this->faker->word,
        'external_link' => $this->faker->word,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
