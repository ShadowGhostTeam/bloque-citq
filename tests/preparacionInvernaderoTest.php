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


    ////////////////////////////////////////////////MODIFICAR/////////////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group preparacionModificarInvernadero"

    /*Unidad*/
    /**
     * @group preparacionModificarInvernadero
     */
    public function testRutaModificar(){
        $response = $this->call('GET', 'invernadero/preparacion/modificar/13');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group preparacionModificarInvernadero
     */
    public function testModificarIdIncorrecto(){
        $response = $this->call('GET', 'invernadero/preparacion/modificar/120');
        $this->assertEquals(404, $response->status());
    }


    ////////////////////////////////////////////////CONSULTAR/////////////////////////////////////////////////////////

//para llamar a solo un grupo "phpunit --group preparacionConsultarInvernadero"

    /*Unidad*/
    /**
     * @group preparacionConsultarInvernadero
     */
    public function testRutaConsultar(){
        $response = $this->call('GET', 'invernadero/preparacion/consultar/12');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group preparacionConsultarInvernadero
     */
    public function testConsultarIdIncorrecto(){
        $response = $this->call('GET', 'invernadero/preparacion/consultar/120');
        $this->assertEquals(404, $response->status());
    }


    ////////////////////////////////////////////////BUSCAR///////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group preparacionBuscarInvernadero"

    /*Unidad*/
    /**
     * @group preparacionBuscarInvernadero
     */

    public function testRutaBuscar(){
        $response = $this->call('GET', 'invernadero/preparacion');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group preparacionBuscarInvernadero
     */
    public function testBuscarInvernaderoCorrecto(){
        $this->visit('invernadero/preparacion')
            ->select(1,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group preparacionBuscarInvernadero
     */
    public function testBuscarFechaCorrecto(){
        $this->visit('invernadero/preparacion')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }


    /**
     * @group preparacionBuscarInvernadero
     */
    public function testBuscarInvernaderoFechaCorrecto(){
        $this->visit('invernadero/preparacion')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"Invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group preparacionBuscarInvernadero
     */
    public function testBuscarUnaFecha(){
        $this->visit('invernadero/preparacion/lista?invernadero=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group preparacionBuscarInvernadero
     */
    public function testBuscarUnaFechaTexto(){
        $this->visit('invernadero/preparacion/lista?invernadero=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group preparacionBuscarInvernadero
     */
    public function testBuscarFechasTexto(){
        $this->visit('invernadero/preparacion/lista?invernadero=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group preparacionBuscarInvernadero
     */
    public function testBuscarInvernaderoTexto(){
        $this->visit('invernadero/preparacion/lista?invernadero=asdasd&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group preparacionBuscarInvernadero
     */
    public function testBuscarInvernaderoInexistente(){
        $this->visit('invernadero/preparacion/lista?invernadero=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
}
