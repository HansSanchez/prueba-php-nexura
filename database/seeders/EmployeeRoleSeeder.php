<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_roles')->delete(); // ELIMINA LOS DATOS QUE TENGA CREADOS (ESTO SE HACE SOLO LA PRIMERA VEZ)
        DB::table('employee_roles')->insert(array( // CREA LOS USUARIOS QUE NECESITEMOS ( EN ESTE CASO 1 Y 2 )
            0 =>
                array(
                    'id' => 1,
                    'employee_id' => 1,
                    'role_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            1 =>
                array(
                    'id' => 2,
                    'employee_id' => 1,
                    'role_id' => 7,
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            2 =>
                array(
                    'id' => 3,
                    'employee_id' => 1,
                    'role_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            3 =>
                array(
                    'id' => 4,
                    'employee_id' => 2,
                    'role_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            4 =>
                array(
                    'id' => 5,
                    'employee_id' => 2,
                    'role_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
        ));
    }
}
