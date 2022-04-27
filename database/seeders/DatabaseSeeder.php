<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Role;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** Factories */
        /*
        Role::factory(100)->create();
        Department::factory(100)->create();
        Category::factory(100)->create();
        Provider::factory(100)->create();
        Warehouse::factory(100)->create();
        Company::factory(100)->create();
        Employee::factory(100)->create();
        Product::factory(100)->create();
        */

        /** Seeders */
        $this->call(CategorySeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProviderSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WarehouseSeeder::class);
    }
}
