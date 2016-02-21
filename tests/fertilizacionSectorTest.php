<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class fertilizacionSectorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /**
     * @group fertilizacionSector
     */
    //para llamar a solo un grupo phpunit --group fertilizacionSector
    public function testNoSector()
    {
        $this->visit('sector/fertilizacion/crear')
            ->select(1,"fuente")
            ->type("18/02/2016","fecha")
            ->type("2","cantidad")
            ->press('Crear')
            ->see("El campo sector es obligatorio");
    }


    /**
     * @group fertilizacionSector
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testNoSiembra()
    {
        $this->visit('sector/fertilizacion/crear')
            ->type("2","cantidad")
            ->press('Crear')
            ->see("El campo siembra es obligatorio");
    }

    /**
     * @group fertilizacionSector
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testNoFuente()
    {
        $this->visit('sector/fertilizacion/crear')
            ->type("2","cantidad")
            ->press('Crear')
            ->see("El campo fuente es obligatorio");
    }


    //////////////////////////////UNIDAD/////////////////////////////

    /**
     * @group fertilizacionSector
     */
    public function testRutaAgregar()
    {
        $response = $this->call('GET', 'sector/fertilizacion/crear');
        $this->assertEquals(200, $response->status());
    }
}
