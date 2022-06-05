<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_roles', function (Blueprint $table) {
            $table->id(); // ID
            $table->foreignId('employee_id')->references('id')
                ->on('employees')
                ->onUpdate('cascade')
                ->onDelete('cascade'); // EMPLEADO
            $table->foreignId('role_id')->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade'); // ROL
            $table->timestamps(); // FECHAS DE CREACIÓN Y ACTUALIZACIÓN
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_roles');
    }
}
