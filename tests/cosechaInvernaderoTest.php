<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class cosechaInvernaderoTest extends TestCase
{
    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group cosechaCrearInvernadero

    /*Unidad*/
    /**
     * @group cosechaCrearInvernadero
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'invernadero/cosecha/crear');
        $this->assertEquals(200, $response->status());
    }

    ////////////////////////////////////////////////MODIFICAR/////////////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group cosechaModificarInvernadero"

    /*Unidad*/
    /**
     * @group cosechaModificarInvernadero
     */
    public function testRutaModificar(){
        $response = $this->call('GET', 'invernadero/cosecha/modificar/12');
        $this->assertEquals(200, $response->status());
    }

    ////////////////////////////////////////////////CONSULTAR/////////////////////////////////////////////////////////

//para llamar a solo un grupo "phpunit --group cosechaConsultarInvernadero"

    /*Unidad*/
    /**
     * @group cosechaConsultarInvernadero
     */
    public function testRutaConsultar(){
        $response = $this->call('GET', 'invernadero/cosecha/consultar/12');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group cosechaConsultarInvernadero
     */
    public function testConsultarIdIncorrecto(){
        $response = $this->call('GET', 'invernadero/cosecha/consultar/120');
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
