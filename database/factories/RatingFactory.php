<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Rating::class;
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'rating' => $this->faker->numberBetween(1, 5),
            'message' => $this->faker->paragraph(),
        ];
    }
}
