<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassroomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Classroom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject_id' => $this->faker->randomDigitNotNull,
        'teaching_period_id' => $this->faker->randomDigitNotNull,
        'slug' => $this->faker->word,
        'code' => $this->faker->word,
        'title' => $this->faker->word,
        'description' => $this->faker->text,
        'start_at' => $this->faker->word,
        'end_at' => $this->faker->word,
        'created_by' => $this->faker->randomDigitNotNull,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
