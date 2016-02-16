<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AplicacionRiego extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicacionRiego', function (Blueprint $table) {
            $table->increments('id');

            $table->dateTime('fecha');
            $table->text('producto');
            $table->integer('cantidad');
            $table->integer('frecuenciaDeRiegos');
            $table->text('descripcion');

            $table->integer('id_siembraPlantula')->unsigned();
            $table->foreign('id_siembraPlantula')->references('id')->on('siembraPlantula');

            $table->integer('id_invernaderoPlantula')->unsigned();
            $table->foreign('id_invernaderoPlantula')->references('id')->on('invernaderoPlantula');

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
        Schema::drop('aplicacionRiego');
    }
}
