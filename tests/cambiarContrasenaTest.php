<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class cambiarContrasenaTest extends TestCase
{
    ///////////////////////////////////////get//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group configuracion

    /*Unidad*/
    /**
     * @group configuracion
     */
    public function testRutaGet(){
        $response = $this->call('GET', 'configuracion');
        $this->assertEquals(200, $response->status());
    }


}
