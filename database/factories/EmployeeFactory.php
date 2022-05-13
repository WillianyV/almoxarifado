<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->name(),
            'code'    => $this->faker->number_format(),
            'cpf'     => $this->faker->unique()->postcode(),
            'status'  => $this->faker->boolean(),
            'role_id' => Role::factory(),
            'department_id' => Department::factory(),
            'company_id'    => Company::factory(),
        ];
    }
}
