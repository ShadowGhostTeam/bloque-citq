<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class cosechaInvernaderoTest extends TestCase
{


    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group fertilizacionBuscarSector

    /*Unidad*/
    /**
     * @group fertilizacionBuscarSector
     */
    public function testRutaBuscar()
    {
        $response = $this->call('GET', 'sector/fertilizacion');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarNoParametros()
    {
        $this->visit('sector/fertilizacion')
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarSectorCorrecto()
    {
        $this->visit('sector/fertilizacion')
            ->select(1, "sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarFuenteCorrecto()
    {
        $this->visit('sector/fertilizacion')
            ->select(1, "fuente")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarFechaCorrecto()
    {
        $this->visit('sector/fertilizacion')
            ->type("29/02/2015", "fechaInicio")
            ->type("29/02/2016", "fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarSectorFechaCorrecto()
    {
        $this->visit('sector/fertilizacion')
            ->type("29/02/2015", "fechaInicio")
            ->type("29/02/2016", "fechaFin")
            ->select(1, "sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarFuenteFechaCorrecto()
    {
        $this->visit('sector/fertilizacion')
            ->type("29/02/2015", "fechaInicio")
            ->type("29/02/2016", "fechaFin")
            ->select(1, "fuente")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarSectorFuenteFechaCorrecto()
    {
        $this->visit('sector/fertilizacion')
            ->type("29/02/2015", "fechaInicio")
            ->type("29/02/2016", "fechaFin")
            ->select(1, "sector")
            ->select(1, "fuente")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarUnaFecha()
    {
        $this->visit('sector/fertilizacion/lista?sector=&fuente=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarUnaFechaTexto()
    {
        $this->visit('sector/fertilizacion/lista?sector=&fuente=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarFechasTexto()
    {
        $this->visit('sector/fertilizacion/lista?sector=&fuente=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarSectorTexto()
    {
        $this->visit('sector/fertilizacion/lista?sector=asdasd&fuente=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarFuenteTexto()
    {
        $this->visit('sector/fertilizacion/lista?sector=&fuente=zfzfdf&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarSectorInexistente()
    {
        $this->visit('sector/fertilizacion/lista?sector=1000&fuente=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarFuenteInexistente()
    {
        $this->visit('sector/fertilizacion/lista?sector=&fuente=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }







    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group fertilizacionCrearSector

    /*Unidad*/
    /**
     * @group fertilizacionCrearSector
     */
    public function testRutaCrear()
    {
        $response = $this->call('GET', 'sector/fertilizacion/crear');
        $this->assertEquals(200, $response->status());
    }


////////////////////////////////////////////////MODIFICAR/////////////////////////////////////////////////////////////////

//para llamar a solo un grupo "phpunit --group fertilizacionModificarSector"

    /*Unidad*/
    /**
     * @group fertilizacionModificarSector
     */
    public function testRutaModificar()
    {
        $response = $this->call('GET', 'sector/fertilizacion/modificar/12');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @group fertilizacionModificarSector
     */
    public function testModificarIdIncorrecto()
    {
        $response = $this->call('GET', 'sector/fertilizacion/modificar/120');
        $this->assertEquals(404, $response->status());
    }

////////////////////////////////////////////////CONSULTAR/////////////////////////////////////////////////////////

//para llamar a solo un grupo "phpunit --group fertilizacionConsultarSector"

    /*Unidad*/
    /**
     * @group fertilizacionConsultarSector
     */
    public function testRutaConsultar()
    {
        $response = $this->call('GET', 'sector/fertilizacion/consultar/12');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @group fertilizacionConsultarSector
     */
    public function testConsultarIdIncorrecto()
    {
        $response = $this->call('GET', 'sector/fertilizacion/consultar/120');
        $this->assertEquals(404, $response->status());
    }

}
