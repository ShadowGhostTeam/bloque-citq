<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PreparacionInvernadero extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparacionInvernadero', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('charolas')->unsigned();
            $table->integer('bolisNuevos')->unsigned();
            $table->integer('bolisReciclados')->unsigned();
            $table->integer('macetas')->unsigned();
            $table->dateTime('fecha');


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
        Schema::drop('preparacionInvernadero');
    }
}
