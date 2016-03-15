<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FertilizacionRiego extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fertilizacion_riego', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->enum('etapaFenologica',['Etapa1']);
            $table->integer('tiempoRiego')->unsigned();
            $table->integer('frecuencia')->unsigned();
            $table->string('formulacion');

            //Se abrevio siembraTransplante a st porque el nombre era muy largo y sql no lo aceptaba
            $table->integer('id_stInvernadero')->unsigned();
            $table->foreign('id_stInvernadero')->references('id')->on('siembra_invernadero');

            $table->integer('id_invernadero')->unsigned();
            $table->foreign('id_invernadero')->references('id')->on('invernadero');

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
        Schema::drop('fertilizacionRiego');
    }
}
