<?php

namespace Database\Seeders;

use App\Models\Holding;
use App\Models\Portfolio;
use App\Models\Security;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $securities = Security::factory()->count(10)->create();

        $portfolios = Portfolio::factory()
            ->count(2)
            ->create(['user_id' => $user->id]);

        foreach ($portfolios as $portfolio) {
            foreach ($securities->random(4) as $security) {
                Holding::factory()->create([
                    'portfolio_id' => $portfolio->id,
                    'security_id' => $security->id,
                ]);
            }
        }
    }
}
