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
            $table->enum('tipoSiembra',['Charolas','Bolis nuevos','Bolis reciclados','Macetas']);
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
