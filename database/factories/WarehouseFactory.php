<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
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
            'site_key'  => 0.0,
            'short_address'  => $this->faker->text(50),
            'short_address_ru'  => $this->faker->text(50),
            'phone'  => $this->faker->phoneNumber(),
            'type_of_warehouse'  => $this->faker->unique()->text(36),
            'number'  => $this->faker->numberBetween(0, 100),
            'city_ref'  => $this->faker->unique()->text(36),
            'city_description'  => $this->faker->text(50),
            'city_description_ru'  => $this->faker->text(50),
            'settlement_ref'  => $this->faker->text(30),
            'settlement_description'  => $this->faker->text(30),
            'settlement_area_description'  => $this->faker->text(30),
            'settlement_regions_description'  => $this->faker->text(30),
            'settlement_type_description'  => $this->faker->text(30),
            'settlement_type_description_ru'  => $this->faker->text(30),
            'longitude'  => 123,
            'latitude'  => 456,
            'post_finance'  => false,
            'bicycle_parking'  => $this->faker->text(30),
            'payment_access'  => $this->faker->text(30),
            'posterminal'  => false,
            'international_shipping'  => false,
            'self_service_workplaces_count'  => false,
            'total_max_weight_allowed'  => 10,
            'place_max_weight_allowed'  => 20,
            'sending_limitations_on_dimensions'  => ['width' => 123, 'height' => 456],
            'district_code'  => $this->faker->text(30),
            'warehouse_status'  => $this->faker->text(30),
            'warehouse_status_date'  => $this->faker->text(30),
            'category_of_warehouse'  => $this->faker->text(30),
            'direct'  => $this->faker->text(30),
            'region_city'  => $this->faker->text(30),
            'warehouse_for_agent'  => false,
            'max_declared_cost'  => 123,
            'schedule'  => [],
            'delivery'  => [],
            'reception'  => [],
            'receiving_limitations_on_dimensions'  => [],
        ];
    }
}
