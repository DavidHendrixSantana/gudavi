<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
          
            $table->id();
            $table->string('nombre');
            $table->string('tutor');
            $table->string('edad');
            $table->string('telefono');
            $table->string('nivel');
            $table->integer('teacher_id');
            $table->integer('schedule_id');
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
        Schema::dropIfExists('class_person');
    }
}