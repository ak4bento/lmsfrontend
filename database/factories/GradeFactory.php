<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gradeable_id' => $this->faker->randomDigitNotNull,
        'gradeable_type' => $this->faker->word,
        'grading_method' => $this->faker->word,
        'comments' => $this->faker->text,
        'grade' => $this->faker->randomDigitNotNull,
        'completed_at' => $this->faker->date('Y-m-d H:i:s'),
        'graded_by' => $this->faker->randomDigitNotNull,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
