<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelefonosTableSeeder extends Seeder
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
                DB::table('telefonos')->insert([
                    'contacto_id' => $contacto_id,
                    'numero' => $faker->phoneNumber,
                    'tipo' => $faker->randomElement(['Móvil', 'Casa', 'Trabajo']),
                ]);
            }
        }
    }
}
