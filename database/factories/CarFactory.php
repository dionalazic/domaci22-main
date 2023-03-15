<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'model'=>$this->faker->word(),
            'doors_number'=>$this->faker->numberBetween(3,5),
            'year'=>$this->faker->numberBetween(2002,2023),
            'manufacturer_id'=> Manufacturer::factory(),
            'user_id'=> User::factory()
        ];
    }
}
