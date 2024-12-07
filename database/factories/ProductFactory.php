<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

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
    protected $model = Product::class;
    public function definition()
    {
        return [
            'id' => Str::uuid(),  // Generate a UUID for the product
            'type_id' => ProductType::factory(),  // Create a related ProductType
            'name' => $this->faker->word(),  // Random product name
            'image_url' => $this->faker->imageUrl(),  // Random image URL
        ];
    }
}
