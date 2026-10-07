<?php

namespace Database\Factories;

use App\Models\Holding;
use App\Models\Portfolio;
use App\Models\Security;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Holding>
 */
class HoldingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'portfolio_id' => Portfolio::factory(),
            'security_id' => Security::factory(),
            'quantity' => fake()->numberBetween(1, 500),
            'purchase_price' => fake()->randomFloat(2, 1, 1000),
            'purchase_date' => fake()->dateTimeBetween('-5years', 'now'),
        ];
    }
}
