<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'corporateName' => $this->faker->sentence(),
            'fantasyName'   => $this->faker->sentence(),
            'cnpj'          => $this->faker->unique()->postcode(),
            'address_id'    => Address::factory(),
            'status'        => $this->faker->boolean(),
            'warehouse_id'  => Warehouse::factory(),
        ];
    }
}
