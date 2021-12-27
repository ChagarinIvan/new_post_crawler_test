<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ref' => $this->faker->unique()->text(36),
            'description' => $this->faker->text(50),
            'description_ru' => $this->faker->text(50),
            'delivery_1' => false,
            'delivery_2' => false,
            'delivery_3' => false,
            'delivery_4' => false,
            'delivery_5' => false,
            'delivery_6' => false,
            'delivery_7' => false,
            'area' => $this->faker->unique()->text(36),
            'settlement_type' => $this->faker->text(10),
            'is_branch' => false,
            'conglomerates' => $this->faker->text(10),
            'city_id' => $this->faker->numberBetween(0, 500),
            'settlement_type_description_ru' => $this->faker->text(10),
            'settlement_type_description' => $this->faker->text(10),
        ];
    }
}
