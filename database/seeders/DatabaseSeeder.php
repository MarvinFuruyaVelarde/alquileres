<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\UsuarioRegional;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ExpedidoTableSeeder::class);
        $this->call(EstadoTableSeeder::class);
        $this->call(UsersTableSeeder::class);        
        $this->call(RegionalTableSeeder::class);
        $this->call(UsuarioRegionalTableSeeder::class);
        $this->call(AeropuertoTableSeeder::class);
        $this->call(MonedaTableSeeder::class);
        $this->call(CuentaTableSeeder::class);
        $this->call(ExpensaTableSeeder::class);
        $this->call(FormaPagoTableSeeder::class);
        $this->call(UnidadMedidaTableSeeder::class);
        $this->call(TipoIdentificacionTableSeeder::class);
        $this->call(TipoSolicitanteTableSeeder::class);
        $this->call(RubroTableSeeder::class);
    }
}
