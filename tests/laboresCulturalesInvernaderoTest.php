<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class laboresCulturalesInvernaderoTest extends TestCase
{
    ///////////////CREAR
    ///para llamar a un grupo phpunit --group laboresCulturalesModificar
    /*Unidad*/
    /**
     * @group laboresCulturalesCrear
     */
    public function testRutaConsultar(){
        $response = $this->call('GET', 'invernadero/laboresCulturales/crear');
        $this->assertEquals(200, $response->status());
    }
    ///////////////MODIFICAR
    /*Unidad*/
    /**
     * @group laboresCulturalesModificar
     */
    public function testRutaModificar(){
        $response = $this->call('GET', 'invernadero/laboresCulturales/modificar/1');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @group laboresCulturalesModificar
     */
    public function testModificarIdIncorrecto(){
        $response = $this->call('GET', 'invernadero/laboresCulturales/modificar/120');
        $this->assertEquals(404, $response->status());
    }
}
