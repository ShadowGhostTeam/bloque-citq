<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class preparacionSectorModificar extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /**
     * @group preparacionSectorModificar
     */
    //para llamar a solo un grupo phpunit --group preparacionSectorModificar
    public function testNoSector()
    {
        $this->visit('sector/preparacion/modificar/1')
            ->select('',"sector")
            ->press("Modificar")
            ->see("El campo sector es obligatorio");
    }


    /**
     * @group preparacionSectorModificar
     */
    //para llamar a solo un grupo phpunit --group preparacionSectorModificar
    public function testNoMaquinaria()
    {
        $this->visit('sector/preparacion/modificar/1')
            ->select('',"maquinaria")
            ->press("Modificar")
            ->see("El campo maquinaria es obligatorio");
    }

    /**
     * @group preparacionSectorModificar
     */
    //para llamar a solo un grupo phpunit --group preparacionSectorModificar
    public function testNoFecha()
    {
        $this->visit('sector/preparacion/modificar/1')
            ->type('',"fecha")
            ->press("Modificar")
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group preparacionSectorModificar
     */
    //para llamar a solo un grupo phpunit --group preparacionSectorModificar
    public function testNoPasadas()
    {
        $this->visit('sector/preparacion/modificar/1')
            ->type('',"numPasadas")
            ->press("Modificar")
            ->see("El campo número de pasadas es obligatorio");
    }


    /**
     * @group preparacionSectorModificar
     */
    //para llamar a solo un grupo phpunit --group preparacionSectorModificar
    public function testCorrecto()
    {
        $this->visit('sector/preparacion/modificar/1')
            ->select(1,"sector")
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Modificar')
            ->see("ha sido modificada");
    }


    //////////////////////////////UNIDAD/////////////////////////////

    /**
     * @group preparacionSectorModificar
     */
    public function testRutaModificar()
    {
        $response = $this->call('GET', 'sector/preparacion/modificar/1');
        $this->assertEquals(200, $response->status());
    }
}
