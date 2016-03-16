<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CosechaInvernadero extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cosecha_invernadero', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->text('comentario');

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
        Schema::drop('cosechaInvernadero');
    }
}
