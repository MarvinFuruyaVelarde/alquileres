<?php

namespace Database\Seeders;

use App\Models\UsuarioRegional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioRegionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsuarioRegional::create(['usuario'=>'2', 'regional'=>'1']);
        UsuarioRegional::create(['usuario'=>'3', 'regional'=>'1']);
    }
}
