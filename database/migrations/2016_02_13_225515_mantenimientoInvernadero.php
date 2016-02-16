<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MantenimientoInvernadero extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientoInvernadero', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->enum('actividad',['Deshoje','Despunte','Brote','Poda','Fungicida','Herbicida','Insecticida']);
            $table->enum('tipoAplicacion',['Al suelo','Al follaje','Boli','Sistema']);
            $table->string('producto');
            $table->integer('cantidad')->unsigned();

            //Se abrevio siembraTransplante a st porque el nombre era muy largo y sql no lo aceptaba
            $table->integer('id_stInvernadero')->unsigned();
            $table->foreign('id_stInvernadero')->references('id')->on('siembraTransplanteInvernadero');
        /*
            $table->integer('id_invernadero')->unsigned();
            $table->foreign('id_invernadero')->references('id')->on('invernadero');
          */
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
        Schema::drop('mantenimientoInvernadero');
    }
}
