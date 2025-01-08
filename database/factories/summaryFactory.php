<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\summary>
 */
class summaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_appliances' => $this->faker->numberBetween(1, 5),
            'total_power' => $this->faker->numberBetween(1, 1000),
            'total_usage_time' => $this->faker->numberBetween(1, 30000),
            'created_at' => $this->faker->unique()->dateTimeBetween('2025-01-06', now()),
            'updated_at' => $this->faker->unique()->dateTimeBetween('2025-01-08', now()),

        ];
    }
}
