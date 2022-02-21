<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provider = new Provider();
        $provider->name = 'Cláudio e Vitor Alimentos ME';
        $provider->cnpj = '40907523000130';
        $provider->status = true;
        $provider->save();
    }
}
