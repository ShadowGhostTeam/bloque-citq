<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SiembraPlantula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siembra_plantula', function (Blueprint $table) {
            //
            $table->increments('id');

            $table->dateTime('fecha');
            $table->enum('status',['Activo','Terminado']);
            $table->enum('contenedor',['Tipo1','Tipo2']);
            $table->integer('numPlantas')->unsigned();
            $table->string('sustrato');
            $table->text('comentario');

            $table->dateTime('fechaTerminacion');
            $table->enum('destino',['Campo','Invernadero']);
            $table->string('variedad');

            $table->integer('id_cultivo')->unsigned();
            $table->foreign('id_cultivo')->references('id')->on('cultivo');


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
        Schema::drop('siembraPlantula');
    }
}
