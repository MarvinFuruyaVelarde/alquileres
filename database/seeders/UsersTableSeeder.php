<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>'Super Administrador',
            'email'=>'superadmin@gmail.com',
            'password'=>bcrypt('9876543210*'),
        ])->assignRole('superadmin');
    }
}
