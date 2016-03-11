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
        Schema::create('salidaPlanta', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->text('comentario');

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
        Schema::drop('salidaPlanta');
    }
}
