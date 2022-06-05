<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class, // CREO PRIMERO LOS USUARIOS QUE VAN A MANEJAR EL SISTEMA
            AreaSeeder::class, // CREO LAS ÁREAS DE LA EMPRESA
            RoleSeeder::class, // CREO LOS ROLES DEL SISTEMA
            EmployeeSeeder::class, // CREO LOS EMPLEADOS DE LA EMPRESA
            EmployeeRoleSeeder::class, // CREO LOS ROLES DE LOS EMPLEADOS EN EL SISTEMA
        ]);
    }
}
