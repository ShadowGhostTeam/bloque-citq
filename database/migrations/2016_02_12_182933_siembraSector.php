<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SiembraSector extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siembraSector', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->enum('tipo',['Maquinaria','A mano']);
            $table->enum('temporada',['Primavera-Verano','Otoño-Invierno']);
            $table->enum('status',['Activo','Terminado']);
            $table->dateTime('fechaTerminacion');
            $table->string('variedad');
            $table->text('comentario');

            $table->integer('id_cultivo')->unsigned();
            $table->foreign('id_cultivo')->references('id')->on('cultivo');

            $table->integer('id_sector')->unsigned();
            $table->foreign('id_sector')->references('id')->on('sector');
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
        Schema::drop('siembraSector');
    }
}
