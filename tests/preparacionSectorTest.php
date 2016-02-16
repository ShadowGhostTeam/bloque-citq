<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class preparacionSectorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /**
     * @group preparacionSector
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testNoSector()
    {
        $this->visit('sector/preparacion/crear')
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Crear')
            ->see("El campo sector es obligatorio");
    }


    /**
     * @group preparacionSector
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testNoMaquinaria()
    {
        $this->visit('sector/preparacion/crear')
            ->type("2","numPasadas")
            ->press('Crear')
            ->see("El campo maquinaria es obligatorio");
    }

    /**
     * @group preparacionSector
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testNoFecha()
    {
        $this->visit('sector/preparacion/crear')
            ->select(1,"maquinaria")
            ->type("2","numPasadas")
            ->press('Crear')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group preparacionSector
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testNoPasadas()
    {
        $this->visit('sector/preparacion/crear')
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("El campo número de pasadas es obligatorio");
    }


    /**
     * @group preparacionSector
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testCorrecto()
    {
        $this->visit('sector/preparacion/crear')
            ->select(1,"sector")
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Crear')
            ->see("La preparacion ha sido agregada");
    }


    //////////////////////////////UNIDAD/////////////////////////////

    /**
     * @group preparacionSector
     */
    public function testRutaAgregar()
    {
        $response = $this->call('GET', 'sector/preparacion/crear');
        $this->assertEquals(200, $response->status());
    }




}
