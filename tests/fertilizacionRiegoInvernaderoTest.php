<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class fertilizacionRiegoInvernaderoTest extends TestCase
{
    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group fertilizacionRiegoCrearInvernadero

    /*Unidad*/
    /**
     * @group fertilizacionRiegoCrearInvernadero
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'invernadero/fertilizacionRiego/crear');
        $this->assertEquals(200, $response->status());
    }

}
