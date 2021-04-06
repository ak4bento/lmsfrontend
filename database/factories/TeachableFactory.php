<?php

namespace Database\Factories;

use App\Models\Teachable;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeachableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teachable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'teachable_id' => $this->faker->randomDigitNotNull,
        'teachable_type' => $this->faker->word,
        'classroom_id' => $this->faker->randomDigitNotNull,
        'available_at' => $this->faker->date('Y-m-d H:i:s'),
        'expires_at' => $this->faker->date('Y-m-d H:i:s'),
        'final_grade_weight' => $this->faker->randomDigitNotNull,
        'max_attempts_count' => $this->faker->randomDigitNotNull,
        'order' => $this->faker->randomDigitNotNull,
        'pass_threshold' => $this->faker->randomDigitNotNull,
        'created_by' => $this->faker->randomDigitNotNull,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
