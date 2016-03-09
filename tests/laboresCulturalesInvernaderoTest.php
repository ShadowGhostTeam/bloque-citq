<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class laboresCulturalesInvernaderoTest extends TestCase
{
    ///////////////CREAR
    /*Unidad*/
    /**
     * @group laboresCulturalesCrear
     */
    public function testRutaConsultar(){
        $response = $this->call('GET', 'invernadero/laboresCulturales/crear');
        $this->assertEquals(200, $response->status());
    }
}
