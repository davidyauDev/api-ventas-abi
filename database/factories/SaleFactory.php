<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->uuid(),
            'customer_name' => $this->faker->name(),
            'customer_identification' => $this->faker->numerify('########'),
            'customer_email' => $this->faker->optional()->safeEmail(),
            'seller' => $this->faker->name(),
            'total_amount' => 0,
            'sale_date' => now()
        ];
    }
}
