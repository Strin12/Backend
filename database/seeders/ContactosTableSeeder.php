<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactosTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $usuarios = DB::table('users')->pluck('id');

        foreach ($usuarios as $usuario_id) {
            for ($i = 0; $i < 5; $i++) {
                DB::table('contactos')->insert([
                    'usuario_id' => $usuario_id,
                    'nombre' => $faker->firstName,
                    'apellido' => $faker->lastName,
                    'fecha_nacimiento' => $faker->date(),
                ]);
            }
        }
    }
}
