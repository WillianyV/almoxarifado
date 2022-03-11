<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name              = 'Lia';
        $user->cpf               = '57032232965';
        $user->password          = '12345678';
        $user->type              = 'ADMIN';
        $user->type              = 'ADMIN';
        $user->status            = true;
        $user->warehouse_id      = 1;
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();
    }
}
