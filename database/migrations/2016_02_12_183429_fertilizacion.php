<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fertilizacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fertilizacion', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->string('programaNPK');
            $table->double('cantidad')->unsigned();
            $table->enum('tipo',['Riego','Aplicacion dirigida']);
            $table->string('fuente');



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
        Schema::drop('fertilizacion');
    }
}
