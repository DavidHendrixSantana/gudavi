<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesPendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_pend', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->unsigned();
            $table->foreign('class_id')->references('id')->on('days_classes');
            $table->datetime('fecha_clase');
            $table->string('motivo_falta');
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
        Schema::dropIfExists('classes_pend');
    }
}