<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'report_type' => $this->faker->randomElement(['daily', 'weekly', 'monthly']),
            'report_date' => now(),
            'data' => json_encode(['sales' => $this->faker->numberBetween(100, 1000)]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

