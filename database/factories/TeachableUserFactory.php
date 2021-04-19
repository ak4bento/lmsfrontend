<?php

namespace Database\Factories;

use App\Models\TeachableUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeachableUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeachableUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'classroom_user_id' => $this->faker->randomDigitNotNull,
        'teachable_id' => $this->faker->randomDigitNotNull,
        'completed_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
