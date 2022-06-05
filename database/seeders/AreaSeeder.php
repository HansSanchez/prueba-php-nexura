<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->delete(); // ELIMINA LOS DATOS QUE TENGA CREADOS (ESTO SE HACE SOLO LA PRIMERA VEZ)
        DB::table('areas')->insert(array( // CREA LAS ÁREAS QUE NECESITEMOS ( EN ESTE CASO 1... AL 6 )
            0 =>
                array(
                    'id' => 1,
                    'name' => 'ADMINISTRACIÓN Y FINANCIERA',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'INGENIERÍA',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'DESARROLLO DE NEGOCIO',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'PROYECTOS',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'SERVICIOS',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'CALIDAD',
                    'created_at' => now(),
                    'updated_at' => now(),
                )
        ));
    }
}
