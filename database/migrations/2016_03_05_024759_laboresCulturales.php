<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LaboresCulturales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labores_culturales', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->enum('actividad',['Colocacion de Clip','Poda de Hoja','Poda de Fruto','Bajada de Planta','Eliminacion de Brotes Laterales',
                'Raleo de Flores','Tutoreo','Eliminacion de Plantas Virosas','Enrollado de Planta','Guia de Planta']);

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
        Schema::drop('LaboresCulturales');
    }
}
