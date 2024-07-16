<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->name(),
            'post_code' => fake()->postcode(),
            'address_1' => fake()->address(),
            'city' => fake()->city(),
            'county' => fake()->city(),
            'country' => fake()->country(),
            'longitude' => fake()->longitude(),
            'latitude' => fake()->latitude(),
        ];
    }
}
