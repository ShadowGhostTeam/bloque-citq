<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MantenimientoSector extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientoSector', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->enum('actividad',['Deshierbe manual', 'Deshierbe máquina','Fungicida','Herbicida','Insecticida']);
            $table->enum('tipoAplicacion',['Sistema','Al suelo', 'Al follaje']);
            $table->string('producto');
            $table->integer('cantidad')->unsigned();

            $table->integer('id_siembra')->unsigned();
            $table->foreign('id_siembra')->references('id')->on('siembraSector');

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
        Schema::drop('mantenimientoSector');
    }
}
