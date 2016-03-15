<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SalidaPlanta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salida_planta', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->text('comentario');

            $table->integer('id_siembraPlantula')->unsigned();
            $table->foreign('id_siembraPlantula')->references('id')->on('siembra_plantula');

            $table->integer('id_invernaderoPlantula')->unsigned();
            $table->foreign('id_invernaderoPlantula')->references('id')->on('invernadero_plantula');

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
        Schema::drop('salidaPlanta');
    }
}
