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
        /*User::create([
            "name"=>'Super Administrador',
            "segundo_nombre"=>'Super Administrador',
            "apellido_paterno"=>'Super Administrador',
            "apellido_materno"=>'Super Administrador',
            'email'=>'superadmin@gmail.com',
            'ci'=>'12345678',
            'expedido'=>'1',
            'estado'=>'1',
            'password'=>bcrypt('9876543210*'),
        ])->assignRole('superadmin');*/

        $user1 = User::create([
            "name" => 'Super Administrador',
            "segundo_nombre" => 'Super Administrador',
            "apellido_paterno" => 'Super Administrador',
            "apellido_materno" => 'Super Administrador',
            'email' => 'superadmin@gmail.com',
            'ci' => '12345678',
            'expedido' => '1',
            'estado' => '1',
            'password' => bcrypt('9876543210*'),
        ]);
        $user1->assignRole('superadmin');

        $user2 = User::create([
            "name" => 'CECILIA',
            "segundo_nombre" => '',
            "apellido_paterno" => 'SOLIZ',
            "apellido_materno" => 'GUZMAN',
            'email' => 'cecilia.soliz@naabol.gob.bo',
            'ci' => '123456',
            'expedido' => '2',
            'estado' => '1',
            'password' => bcrypt('123456'),
        ]);
        $user2->assignRole('ADMINISTRADOR');

        $user3 = User::create([
            "name" => 'ROBERT',
            "segundo_nombre" => 'ELVIS',
            "apellido_paterno" => 'VELIZ',
            "apellido_materno" => 'MAMANI',
            'email' => 'robert.veliz@naabol.gob.bo',
            'ci' => '5501105',
            'expedido' => '4',
            'estado' => '1',
            'password' => bcrypt('5501105'),
        ]);
        $user3->assignRole('ADMINISTRADOR');
    }
}
