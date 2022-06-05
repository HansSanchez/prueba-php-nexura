<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {

            $table->id(); // ID

            $table->string('name'); // NOMBRE

            $table->string('email'); // CORREO ELECTRÓNICO

            $table->enum('sex', ['F', 'M']); // SEXO

            $table->foreignId('area_id') // ÁREA A LA QUE PERTENECE
                ->nullable() // PUEDE SER NULO
                ->references('id') // REFERENCIA LA LLAVE PRIMARIA ...
                ->on('areas') // ... DE LA TABLA AREAS
                ->onDelete('set null'); // EN CASO DE QUE SE BORRE EL ÁREA SE SETA NULO

            $table->boolean('bulletin')->default(0); // AUTORIZA RECIBIR BOLETINES

            $table->longText('description'); // DESCRIPCIÓN DE LA EXPERIENCIA DEL EMPLEADO

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
        Schema::dropIfExists('employees');
    }
}
