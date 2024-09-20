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
            "segundo_nombre"=>'Super Administrador',
            "apellido_paterno"=>'Super Administrador',
            "apellido_materno"=>'Super Administrador',
            'email'=>'superadmin@gmail.com',
            'ci'=>'12345678',
            'expedido'=>'1',
            'estado'=>'1',
            'password'=>bcrypt('9876543210*'),
        ])->assignRole('superadmin');
    }
}
