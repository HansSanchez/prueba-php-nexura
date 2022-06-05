<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete(); // ELIMINA LOS DATOS QUE TENGA CREADOS (ESTO SE HACE SOLO LA PRIMERA VEZ)
        DB::table('roles')->insert(array( // CREA LOS ROLES QUE NECESITEMOS ( EN ESTE CASO 1... AL 8 )
            0 =>
                array(
                    'id' => 1,
                    'name' => 'DESARROLLADOR',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'ANALISTA',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'TESTER',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'DISEÑADOR',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'PROFESIONAL PMO',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'PROFESIONAL DE SERVICIOS',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'AUXILIAR ADMINISTRATIVO',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'CODIRECTOR',
                    'created_at' => now(),
                    'updated_at' => now(),
                )
        ));
    }
}
