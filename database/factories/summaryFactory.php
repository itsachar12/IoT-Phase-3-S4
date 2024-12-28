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
            'total_power' => $this->faker->numberBetween(1, 10000),
            'total_usage_time' => $this->faker->numberBetween(1, 86400),
            'created_at' => $this->faker->unique()->dateTimeBetween('2024-11-01', now()),
            'updated_at' => $this->faker->unique()->dateTimeBetween('2024-11-01', now()),

        ];
    }
}
