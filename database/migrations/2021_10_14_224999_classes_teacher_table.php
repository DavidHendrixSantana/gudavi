<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClassesTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_teacher', function (Blueprint $table) {
        $table->id();
        $table->string('Hora');
        $table->string('Dia');
        $table->integer('teacher_id')->unsigned();
        $table->integer('person_id')->unsigned();

        $table->foreign('teacher_id')->references('id')->on('teachers');

        $table->foreign('person_id')->references('id')->on('persons');

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
        Schema::dropIfExists('classes_teacher');
        
    }
}
