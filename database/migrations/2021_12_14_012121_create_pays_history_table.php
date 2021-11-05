<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays_history', function (Blueprint $table) {
            $table->id();
            $table->integer('person_id');
            $table->string('forma_pago');
            $table->string('tipo_tarjeta');
            $table->double('cantidad');
            $table->date('fecha_pago');
            $table->integer('folio');
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
        Schema::dropIfExists('pays_history');
    }
}
