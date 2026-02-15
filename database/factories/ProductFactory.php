<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $baseBid = $this->faker->numberBetween(10000, 100000);
        $roundedBid = round($baseBid / 1000) * 100;
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'extended_description' => $this->faker->paragraph(20),
            'image_url' => $this->faker->imageUrl(),
            'starter_bid' => $roundedBid * 1000,
            'bid_start_date' => now(),
            'bid_end_date' => now()->addDays(7)
        ];
    }
}
