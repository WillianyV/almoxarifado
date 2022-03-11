<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address'  => 'AVENIDA UM',
            'number'   => '22A',
            'district' => 'PARQUE CAPIBARIBE',
            'zipcode'  => '56400000',
            'city'     => 'SÃO LOURENÇO',
            'state'    => 'PE'
        ];
    }
}
