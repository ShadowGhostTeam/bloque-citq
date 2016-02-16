<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PreparacionSector extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparacionSector', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->integer('numPasadas')->unsigned();

            $table->integer('id_maquinaria')->unsigned();
            $table->foreign('id_maquinaria')->references('id')->on('maquinaria');

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
        Schema::drop('preparacionSector');
    }
}
