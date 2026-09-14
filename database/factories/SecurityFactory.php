<?php

namespace Database\Factories;

use App\Models\Security;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Security>
 */
class SecurityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'ticker' => fake()->lexify('?????'),
            'ISIN' => strtoupper(fake()->unique()->bothify('??##########')),
            'price' => fake()->randomFloat(2, 1, 1000),
            'type' => fake()->randomElement(['Aktie', 'ETF']),
        ];
    }
}
