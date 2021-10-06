<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->date('fecha_nacimiento');
            $table->string('nombre_papa');
            $table->string('edad');
            $table->integer('telefono_papa');
            $table->string('nombre_mama');
            $table->integer('telefono_mama');
            $table->string('correo_electronico');
            $table->string('nombre_emergencia');
            $table->integer('telefono_emergencia');
            $table->date('fecha_inicio');
            $table->string('enfermedad');
            $table->string('nivel');
            $table->integer('clases_semanales');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}