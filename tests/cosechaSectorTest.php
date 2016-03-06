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
            ->select(2,"sector")
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

    ////////////////////////////////////////////////MODIFICAR/////////////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group cosechaModificarSector"

    /*Unidad*/
    /**
     * @group cosechaModificarSector
     */
    public function testRutaModificar(){
        $response = $this->call('GET', 'sector/cosecha/modificar/12');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group cosechaModificarSector
     */
    public function testModificarIdIncorrecto(){
        $response = $this->call('GET', 'sector/cosecha/modificar/120');
        $this->assertEquals(404, $response->status());
    }
    /*Integración*/

    /**
     * @group cosechaModificarSector
     */

    public function testModificarCorrecto(){
        $this->visit('sector/cosecha/modificar/12')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->type("18/02/2016","fecha")
            ->type("Esta es la descripción.","descripcion")
            ->press('Modificar')
            ->see("ha sido modificada");
    }
    /**
     * @group cosechaModificarSector
     */

    public function testModificarNoSector(){
        $this->visit('sector/cosecha/modificar/12')
            ->select("","sector")
            ->select(1,"siembra")
            ->type("18/02/2016","fecha")
            ->type("Esta es la descripción.","descripcion")
            ->press('Modificar')
            ->see("El campo sector es obligatorio");
    }

    /**
     * @group cosechaModificarSector
     */

    public function testModificarNoFecha(){
        $this->visit('sector/cosecha/modificar/12')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->type("Esta es la descripción.","descripcion")
            ->type("","fecha")
            ->press('Modificar')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group cosechaModificarSector
     */
    public function testModificarFechaIncorrecta(){
        $this->visit('sector/cosecha/modificar/12')
            ->select(1, "sector")
            ->select(1,"siembra")
            ->type("asdas","fecha")
            ->press('Modificar')
            ->see("fecha no corresponde al formato d/m/Y");
    }




}

