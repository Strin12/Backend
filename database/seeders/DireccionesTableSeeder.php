<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DireccionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $contactos = DB::table('contactos')->pluck('id');

        foreach ($contactos as $contacto_id) {
            for ($i = 0; $i < 2; $i++) {
                DB::table('direcciones')->insert([
                    'contacto_id' => $contacto_id,
                    'direccion' => $faker->streetAddress,
                    'ciudad' => $faker->city,
                    'estado' => $faker->state,
                    'codigo_postal' => $faker->postcode,
                    'pais' => $faker->country,
                ]);
            }
        }
    }
}
