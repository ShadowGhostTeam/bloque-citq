<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class mantenimientoSectorTest extends TestCase
{
   ////////////////////////////////////////CREAR////////////////////////////////////////////////////
    //para llamar a solo un grupo "phpunit --group mantenimientoCrearSector

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
    public function testCrearNoSector(){
        $this->visit('sector/mantenimiento/crear')
            ->select("Deshierbe manual","actividad")
            ->select("","tipoAplicacion")
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
            ->press('Crear')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group mantenimientoCrearSector
     */

    public function testCrearCantidadNoNumero(){
        $this->visit('sector/mantenimiento/crear')
            ->select(1,"sector")
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
    public function testCrearFechaIncorrecta(){
        $this->visit('sector/mantenimiento/crear')
            ->type("asdas","fecha")
            ->press('Crear')
            ->see("fecha no corresponde al formato d/m/Y");
    }

    ////////////////////////////////////////MODIFICAR////////////////////////////////////////////////////
    //para llamar a solo un grupo "phpunit --group mantenimientoModificarSector

    /*Unidad*/
    /**
     * @group mantenimientoModificarSector
     */

    public function testRutaModificar(){
        $response = $this->call('GET', 'sector/mantenimiento/modificar/1');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group mantenimientoModificarSector
     */

    public function testRutaModificarIncorrecto(){
        $response = $this->call('GET', 'sector/mantenimiento/modificar/1000');
        $this->assertEquals(404, $response->status());
    }

    /*Integracion*/

    /**
     * @group mantenimientoModificarSector
     */
    public function testModificarNoSector(){
        $this->visit('sector/mantenimiento/modificar/1')
            ->select("","sector")
            ->press('Modificar')
            ->see("El campo sector es obligatorio");
    }

    /**
     * @group mantenimientoModificarSector
     */

    public function testModificarNoSiembra(){
        $this->visit('sector/mantenimiento/modificar/1')
            ->select("","siembra")
            ->press('Modificar')
            ->see("El campo siembra es obligatorio");
    }

    /**
     * @group mantenimientoModificarSector
     */

    public function testModificarNoActividad(){
        $this->visit('sector/mantenimiento/modificar/1')
            ->select("","actividad")
            ->type("18/02/2016","fecha")
            ->press('Modificar')
            ->see("El campo actividad es obligatorio");
    }
    /**
     * @group mantenimientoModificarSector
     */
    public function testModificarNoFecha(){
        $this->visit('sector/mantenimiento/modificar/1')
            ->type("","fecha")
            ->press('Modificar')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group mantenimientoModificarSector
     */

    public function testModificarCantidadNoNumero(){
        $this->visit('sector/mantenimiento/modificar/1')
            ->select(1,"sector")
            ->type("correcto 2","producto")
            ->type("asdasd","cantidad")
            ->type("este es mi comentario","comentario")
            ->type("18/02/2016","fecha")
            ->press('Modificar')
            ->see("cantidad debe ser numérico");
    }

    /**
     * @group mantenimientoModificarSector
     */

    public function testModificarCantidadNegativa(){
        $this->visit('sector/mantenimiento/modificar/1')
            ->select(1,"sector")
            ->type("correcto 2","producto")
            ->type("-1","cantidad")
            ->type("este es mi comentario","comentario")
            ->type("18/02/2016","fecha")
            ->press('Modificar')
            ->see("El tamaño de cantidad debe ser de al menos 0");
    }

    /**
     * @group mantenimientoModificarSector
     */
    public function testModificarFechaIncorrecta(){
        $this->visit('sector/mantenimiento/modificar/1')
            ->type("asdas","fecha")
            ->press("Modificar")
            ->see("fecha no corresponde al formato d/m/Y");
    }

///////////////////////////////////////////BUSCAR//////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group mantenimientoBuscarSector

    /*Unidad*/
    /**
     * @group mantenimientoBuscarSector
     */
    public function testRutaBuscar(){
        $response = $this->call('GET', 'sector/mantenimiento');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group mantenimientoBuscarSector
     */
    public function testBuscarNoParametros(){
        $this->visit('sector/mantenimiento')
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group mantenimientoBuscarSector
     */
    public function testBuscarSectorCorrecto(){
        $this->visit('sector/mantenimiento')
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group mantenimientoBuscarSector
     */
    public function testBuscarActividadCorrecto(){
        $this->visit('sector/mantenimiento')
            ->select("Deshierbe manual","actividad")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group mantenimientoBuscarSector
     */
    public function testBuscarFechaCorrecto(){
        $this->visit('sector/mantenimiento')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group mantenimientoBuscarSector
     */
    public function testBuscarSectorFechaCorrecto(){
        $this->visit('sector/mantenimiento')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group mantenimientoBuscarSector
     */
    public function testBuscarActividadFechaCorrecto(){
        $this->visit('sector/mantenimiento')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select("Deshierbe manual","actividad")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group mantenimientoBuscarSector
     */
    public function testBuscarSectorActividadFechaCorrecto(){
        $this->visit('sector/mantenimiento')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"sector")
            ->select("Deshierbe manual","actividad")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group mantenimientoBuscarSector
     */
    public function testBuscarUnaFecha(){
        $this->visit('sector/preparacion/lista?sector=&actividad=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group mantenimientoBuscarSector
     */
    public function testBuscarUnaFechaTexto(){
        $this->visit('sector/preparacion/lista?sector=&actividad=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group mantenimientoBuscarSector
     */
    public function testBuscarFechasTexto(){
        $this->visit('sector/preparacion/lista?sector=&actividad=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group mantenimientoBuscarSector
     */
    public function testBuscarSectorTexto(){
        $this->visit('sector/preparacion/lista?sector=asdasd&actividad=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group mantenimientoBuscarSector
     */
    public function testBuscarSectorInexistente(){
        $this->visit('sector/preparacion/lista?sector=1000&actividad=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarMaquinariaInexistente(){
        $this->visit('sector/preparacion/lista?sector=&actividad=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }






}
