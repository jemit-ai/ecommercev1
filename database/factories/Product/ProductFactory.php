<?php

namespace Database\Factories\Product;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
        return [
            //
              'name' => $this->faker->name,
              'slug' => $this->faker->slug,
              'description' => $this->faker->text,
              'price' => $this->faker->randomDigit(),
              'discount_price' => $this->faker->randomDigit(),
              'stock' => $this->faker->randomDigit(),
            
        ];
    }
}
