<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'code'         => 123,
            'description'  => "Caneta Bic",
            'stock'        => 25,
            'minimumStock' => 3,
            'status'       => true,
            'category_id'  => 1,
            'provider_id'  => 1,
            'warehouse_id' => 1,
        ]);
    }
}
