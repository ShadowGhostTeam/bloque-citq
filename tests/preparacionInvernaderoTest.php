<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


/**
 * Created by PhpStorm.
 * User: Dannyrious
 * Date: 12-Mar-16
 * Time: 3:10 PM
 */
class preparacionInvernaderoTest extends TestCase
{
    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group preparacionCrearInvernadero

    /*Unidad*/
    /**
     * @group preparacionCrearInvernadero
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'invernadero/preparacion/crear');
        $this->assertEquals(200, $response->status());
    }


    /*Integración*/

    /**
     * @group preparacionCrearInvernadero
     */

    public function testCrearCorrecto(){
        $this->visit('invernadero/preparacion/crear')
            ->select(2,"invernadero")
            ->type("1","charolas")
            ->type("1","bolisNuevos")
            ->type("1","bolisReciclados")
            ->type("1","macetas")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("La cosecha ha sido agregada");
    }

    /**
     * @group preparacionCrearInvernadero
     */
    public function testCrearNoInvernadero(){
        $this->visit('invernadero/preparacion/crear')
            ->type("1","charolas")
            ->type("1","bolisNuevos")
            ->type("1","bolisReciclados")
            ->type("1","macetas")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("El campo invernadero es obligatorio");
    }

    /**
     * @group preparacionCrearInvernadero
     */

    public function testCrearNoFecha(){
        $this->visit('invernadero/preparacion/crear')
            ->select(2,"invernadero")
            ->type("1","charolas")
            ->type("1","bolisNuevos")
            ->type("1","bolisReciclados")
            ->type("1","macetas")
            ->press('Crear')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group preparacionCrearInvernadero
     */
    public function testCrearFechaIncorrecta(){
        $this->visit('invernadero/preparacion/crear')
            ->select(2,"invernadero")
            ->type("asdas","fecha")
            ->press('Crear')
            ->see("fecha no corresponde al formato d/m/Y");
    }

    public function testCrearCharolasIncorrecta(){
        $this->visit('invernadero/preparacion/crear')
            ->select(2,"invernadero")
            ->type("a","charolas")
            ->type("1","bolisNuevos")
            ->type("1","bolisReciclados")
            ->type("1","macetas")
            ->press('Crear')
            ->see("El campo charolas es incorrecto");
    }

    public function testCrearBolisNuevosIncorrecta(){
        $this->visit('invernadero/preparacion/crear')
            ->select(2,"invernadero")
            ->type("1","charolas")
            ->type("a","bolisNuevos")
            ->type("1","bolisReciclados")
            ->type("1","macetas")
            ->press('Crear')
            ->see("El campo Bolis Nuevos es incorrecto");
    }

    public function testCrearMacetasIncorrecta(){
        $this->visit('invernadero/preparacion/crear')
            ->select(2,"invernadero")
            ->type("1","charolas")
            ->type("1","bolisNuevos")
            ->type("1","bolisReciclados")
            ->type("a","macetas")
            ->press('Crear')
            ->see("El campo Macetas es incorrecto");
    }

    public function testCrearBoliRecicladosIncorrecta(){
        $this->visit('invernadero/preparacion/crear')
            ->select(2,"invernadero")
            ->type("1","charolas")
            ->type("1","bolisNuevos")
            ->type("a","bolisReciclados")
            ->type("1","macetas")
            ->press('Crear')
            ->see("El campo Bolis Reciclados es incorrecto");
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


    ////////////////////////////////////////////////CONSULTAR/////////////////////////////////////////////////////////

//para llamar a solo un grupo "phpunit --group cosechaConsultarSector"

    /*Unidad*/
    /**
     * @group cosechaConsultarSector
     */
    public function testRutaConsultar(){
        $response = $this->call('GET', 'sector/cosecha/consultar/12');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group cosechaConsultarSector
     */
    public function testConsultarIdIncorrecto(){
        $response = $this->call('GET', 'sector/cosecha/consultar/120');
        $this->assertEquals(404, $response->status());
    }


    ////////////////////////////////////////////////BUSCAR///////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group cosechaBuscarSector"

    /*Unidad*/
    /**
     * @group cosechaBuscarSector
     */

    public function testRutaBuscar(){
        $response = $this->call('GET', 'sector/cosecha');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarSectorCorrecto(){
        $this->visit('sector/cosecha')
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarFechaCorrecto(){
        $this->visit('sector/cosecha')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarSectorFechaCorrecto(){
        $this->visit('sector/cosecha')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarUnaFecha(){
        $this->visit('sector/cosecha/lista?sector=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarUnaFechaTexto(){
        $this->visit('sector/cosecha/lista?sector=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarFechasTexto(){
        $this->visit('sector/cosecha/lista?sector=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarSectorTexto(){
        $this->visit('sector/cosecha/lista?sector=asdasd&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarSectorInexistente(){
        $this->visit('sector/cosecha/lista?sector=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
}
