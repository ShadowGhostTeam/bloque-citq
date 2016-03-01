<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class mantenimientoSectorTest extends TestCase
{
   ////////////////////////////////////////CREAR////////////////////////////////////////////////////
    //para llamar a solo un grupo phpunit --group mantenimientoCrearSector

    /*Unidad*/
    /**
     * @group mantenimientoCrearSector
     */

    public function testRutaCrear(){
        $response = $this->call('GET', 'sector/mantenimiento/crear');
        $this->assertEquals(200, $response->status());
    }

    /*Integracion*/

    /**
     * @group mantenimientoCrearSector
     */

    public function testCrearCorrecto(){
        $this->visit('sector/mantenimiento/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->select(1,"actividad")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("El mantenimiento ha sido agregado");
    }

    /**
     * @group mantenimientoCrearSector
     */

    public function testCrearCorrecto2(){
        $this->visit('sector/mantenimiento/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->select(3,"actividad")
            ->select(1,"tipoAplicacion")
            ->type("correcto 2","producto")
            ->type("1","cantidad")
            ->type("este es mi comentario","comentario")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("El mantenimiento ha sido agregado");
    }

    /**
     * @group mantenimientoCrearSector
     */

    public function testCrearNoSector(){
        $this->visit('sector/mantenimiento/crear')
            ->select(3,"actividad")
            ->select(1,"tipoAplicacion")
            ->type("correcto 2","producto")
            ->type("1","cantidad")
            ->type("este es mi comentario","comentario")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("El campo sector es obligatorio");
    }

    /**
     * @group mantenimientoCrearSector
     */

    public function testCrearNoSiembra(){
        $this->visit('sector/mantenimiento/crear')
            ->select(3,"actividad")
            ->select(1,"tipoAplicacion")
            ->type("correcto 2","producto")
            ->type("1","cantidad")
            ->type("este es mi comentario","comentario")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("El campo siembra es obligatorio");
    }

    /**
     * @group mantenimientoCrearSector
     */

    public function testCrearNoActividad(){
        $this->visit('sector/mantenimiento/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("El campo actividad es obligatorio");
    }
    /**
     * @group mantenimientoCrearSector
     */
    public function testCrearNoFecha(){
        $this->visit('sector/mantenimiento/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->select(1,"actividad")
            ->press('Crear')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group mantenimientoCrearSector
     */

    public function testCrearCantidadNoNumero(){
        $this->visit('sector/mantenimiento/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->select(3,"actividad")
            ->select(1,"tipoAplicacion")
            ->type("correcto 2","producto")
            ->type("asdasd","cantidad")
            ->type("este es mi comentario","comentario")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("cantidad debe ser numérico");
    }

    /**
     * @group mantenimientoCrearSector
     */

    public function testCrearCantidadNegativa(){
        $this->visit('sector/mantenimiento/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->select(3,"actividad")
            ->select(1,"tipoAplicacion")
            ->type("correcto 2","producto")
            ->type("-1","cantidad")
            ->type("este es mi comentario","comentario")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("El tamaño de cantidad debe ser de al menos 0");
    }

    /**
     * @group mantenimientoCrearSector
     */

    public function testCrearTruncarInformacion(){
        $this->visit('sector/mantenimiento/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->select(1,"actividad")
            ->select(1,"tipoAplicacion")
            ->type("correcto 2","producto")
            ->type("-1","cantidad")
            ->type("este es mi comentario","comentario")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("El mantenimiento ha sido agregado");
    }




}
