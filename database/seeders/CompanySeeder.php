<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = Address::create([
            'address'  => 'Avenida Manoel Fernandes Batista',
            'number'   => '108',
            'district' => 'Aparecida',
            'zip_code' => '14883205',
            'city'     => 'Jaboticabal',
            'state'    => 'SP'
        ]);

        Company::create([
            'cnpj'          => '05634711000131',
            'fantasyName'   => 'Entregas Expressas',
            'corporateName' => 'Erick e Camila Entregas Expressas Ltda',
            'status'        => 1,
            'address_id'    => $address->id,
            'warehouse_id'  => 1
        ]);
    }
}
