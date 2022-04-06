<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Provider;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code'         => $this->faker->name(),
            'image'        => $this->faker->name(),
            'description'  => $this->faker->name(),
            'stock'        => 25,
            'minimumStock' => 3,
            'purchaseData' => $this->faker->date(),
            'status'       => $this->faker->boolean(),
            'category_id'  => Category::factory(),
            'provider_id'  => Provider::factory(),
            'warehouse_id' => Warehouse::factory(),
        ];
    }
}
