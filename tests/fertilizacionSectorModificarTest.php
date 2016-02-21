<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class fertilizacionSectorModificarTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /**
     * @group fertilizacionSectorModificar
     */
    //para llamar a solo un grupo phpunit --group fertilizacionSectorModificar
    public function testNoSector()
    {
        $this->visit('sector/fertilizacion/modificar/1')
            ->select('',"sector")
            ->press("Modificar")
            ->see("El campo sector es obligatorio");
    }

    /**
     * @group fertilizacionSectorModificar
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testNoSiembra()
    {
        $this->visit('sector/fertilizacion/modificar/1')
            ->select("","siembra")
            ->press('Modificar')
            ->see("El campo siembra es obligatorio");
    }

    /**
     * @group fertilizacionSectorModificar
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testNoFuente()
    {
        $this->visit('sector/fertilizacion/modificar/1')
            ->select("","fuente")
            ->press('Modificar')
            ->see("El campo fuente es obligatorio");
    }


    //////////////////////////////UNIDAD/////////////////////////////

    /**
     * @group fertilizacionSectorModificar
     */
    public function testRutaModificar()
    {
        $response = $this->call('GET', 'sector/fertilizacion/modificar/1');
        $this->assertEquals(200, $response->status());
    }

    


}
