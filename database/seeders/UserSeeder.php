<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete(); // ELIMINA LOS DATOS QUE TENGA CREADOS (ESTO SE HACE SOLO LA PRIMERA VEZ)
        DB::table('users')->insert(array( // CREA LOS USUARIOS QUE NECESITEMOS ( EN ESTE CASO 1 Y 2 )
            0 =>
                array(
                    'id' => 1,
                    'name' => 'ADMINISTRADOR NEXURA',
                    'email' => 'nexura@nexura.com',
                    'email_verified_at' => NULL,
                    'password' => bcrypt('@Nexura123#'),
                    'remember_token' => NULL,
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'HANS YADIEL SÁNCHEZ MORA',
                    'email' => 'hsanchez@nexura.com',
                    'email_verified_at' => NULL,
                    'password' => bcrypt('@Nexura123#'),
                    'remember_token' => NULL,
                    'created_at' => now(),
                    'updated_at' => now(),
                )
        ));
    }
}
