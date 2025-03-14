<?php

namespace Database\Seeders;

use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Admin::create([
            'username' => 'pablo',
            'email' => 'pablo@osole.com',
            'password' => Hash::make('pablo'),
            'is_admin' => true,
        ]);

        $metadatos = [
            [
                'seccion' => 'Home',
            ],
            [
                'seccion' => 'Nosotros',
            ],
            [
                'seccion' => 'Marcas',
            ],
            [
                'seccion' => 'Novedades',
            ],
            [
                'seccion' => 'Contacto',
            ],
            [
                'seccion' => 'Capacitaciones',
            ],
            [
                'seccion' => 'Productos',
            ],
        ];

        DB::table('metadatos')->insert($metadatos);
    }
}
