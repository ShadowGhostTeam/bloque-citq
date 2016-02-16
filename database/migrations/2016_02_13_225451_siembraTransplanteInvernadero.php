<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SiembraTransplanteInvernadero extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siembraTransplanteInvernadero', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->enum('tipo',['Siembra','Transplante']);
            $table->enum('status',['Activo','Terminado']);
            $table->dateTime('fechaTerminacion');

            $table->integer('id_cultivo')->unsigned();
            $table->foreign('id_cultivo')->references('id')->on('cultivo');

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
        Schema::drop('siembraTransplanteInvernadero');
    }
}
