<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Riego extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riego', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');

            $table->integer('tiempo')->unsigned();
            $table->double('distanciaLineas')->unsigned();
            $table->double('litrosHectarea')->unsigned();
            $table->double('lamina')->unsigned();

            $table->integer('id_siembra')->unsigned();
            $table->foreign('id_siembra')->references('id')->on('siembra_sector');

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
        Schema::drop('riego');
    }
}
