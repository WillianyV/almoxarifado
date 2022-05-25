<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = Address::create([
            'address'  => 'AVENIDA UM',
            'number'   => '22A',
            'district' => 'PARQUE CAPIBARIBE',
            'zipcode'  => '56400000',
            'city'     => 'SÃO LOURENÇO',
            'state'    => 'PE'
        ]);

        Warehouse::create([
            'description' => 'Central',
            'address_id'  => $address->id,
            'status'      => true
        ]);

    }
}
