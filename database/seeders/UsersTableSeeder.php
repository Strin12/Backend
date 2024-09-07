<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 500; $i++) {
            DB::table('users')->insert([
                'nombre' => $faker->name,
                'correo' => $faker->unique()->safeEmail,
                'contrasenia' => bcrypt('password'),
            ]);
        }
    }
}
