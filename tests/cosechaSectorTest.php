<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class cosechaSectorTest extends TestCase
{
    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group cosechaCrearSector

    /*Unidad*/
    /**
     * @group cosechaCrearSector
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'sector/cosecha/crear');
        $this->assertEquals(200, $response->status());
    }


    /*Integración*/

    /**
     * @group cosechaCrearSector
     */

    public function testCrearCorrecto(){
        $this->visit('sector/cosecha/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->type("18/02/2016","fecha")
            ->type("Esta es la descripción","descripcion")
            ->press('Crear')
            ->see("La cosecha ha sido agregada");
    }

    /**
     * @group cosechaCrearSector
     */
    public function testCrearNoSector(){
        $this->visit('sector/cosecha/crear')
            ->select(1,"siembra")
            ->type("18/02/2016","fecha")
            ->type("Esta es la descripción","descripcion")
            ->press('Crear')
            ->see("El campo sector es obligatorio");
    }


    /**
     * @group cosechaCrearSector
     */

    public function testCrearNoSiembra(){
        $this->visit('sector/cosecha/crear')
            ->type("Esta es la descripción","descripcion")
            ->press('Crear')
            ->see("El campo siembra es obligatorio");
    }

    /**
     * @group cosechaCrearSector
     */

    public function testCrearNoFecha(){
        $this->visit('sector/cosecha/crear')
            ->select(1,"siembra")
            ->type("Esta es la descripción","descripcion")
            ->press('Crear')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group cosechaCrearSector
     */
    public function testCrearFechaIncorrecta(){
        $this->visit('sector/cosecha/crear')
            ->select(1,"siembra")
            ->type("asdas","fecha")
            ->press('Crear')
            ->see("fecha no corresponde al formato d/m/Y");
    }
}
