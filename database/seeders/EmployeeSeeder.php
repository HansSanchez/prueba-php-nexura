<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->delete(); // ELIMINA LOS DATOS QUE TENGA CREADOS (ESTO SE HACE SOLO LA PRIMERA VEZ)
        DB::table('employees')->insert(array( // CREA LOS EMPLEADOS QUE NECESITEMOS ( EN ESTE CASO 1 Y 2 )
            0 =>
                array(
                    'id' => 1,
                    'name' => 'PEDRO PÉREZ',
                    'email' => 'pperez@example.co',
                    'sex' => 'M',
                    'area_id' => 3,
                    'bulletin' => true,
                    'description' => 'Hola mundo',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'AMALIA BAYONA',
                    'email' => 'abayona@example.co',
                    'sex' => 'F',
                    'area_id' => 6,
                    'bulletin' => false,
                    'description' => 'Para contactar a Amalia Bayona, puede escribir al correo electrónico abayona@example.co',
                    'created_at' => now(),
                    'updated_at' => now(),
                )
        ));
    }
}
