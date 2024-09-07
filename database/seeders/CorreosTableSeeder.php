<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorreosTableSeeder extends Seeder
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
                DB::table('correos')->insert([
                    'contacto_id' => $contacto_id,
                    'correo' => $faker->unique()->safeEmail,
                    'tipo' => $faker->randomElement(['Personal', 'Trabajo']),
                ]);
            }
        }
    }
}
