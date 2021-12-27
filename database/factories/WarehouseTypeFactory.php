<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseTypeFactory extends Factory
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
        ];
    }
}
