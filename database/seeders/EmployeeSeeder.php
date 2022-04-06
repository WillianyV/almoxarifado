<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name'    => 'Sebastiana Caroline Barros',
            'code'    => '321',
            'cpf'     => '27719879880',
            'status'  => 1,
            'role_id' => 1,
            'department_id' => 1,
            'company_id'    => 1
        ]);
    }
}
