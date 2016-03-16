<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class riegoSectorTest extends TestCase
{


    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group riegoBuscarSector

    /*Unidad*/
    /**
     * @group riegoBuscarSector
     */
    public function testRutaBuscar()
    {
        $response = $this->call('GET', 'sector/riego');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group riegoBuscarSector
     */
    public function testBuscarNoParametros()
    {
        $this->visit('sector/riego')
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarSectorCorrecto()
    {
        $this->visit('sector/riego')
            ->select(1, "sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group riegoBuscarSector
     */
    public function testBuscarFechaCorrecto()
    {
        $this->visit('sector/riego')
            ->type("29/02/2015", "fechaInicio")
            ->type("29/02/2016", "fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group riegoBuscarSector
     */
    public function testBuscarSectorFechaCorrecto()
    {
        $this->visit('sector/riego')
            ->type("29/02/2015", "fechaInicio")
            ->type("29/02/2016", "fechaFin")
            ->select(1, "sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group riegoBuscarSector
     */
    public function testBuscarUnaFecha()
    {
        $this->visit('sector/riego/lista?sector=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group riegoBuscarSector
     */
    public function testBuscarUnaFechaTexto()
    {
        $this->visit('sector/riego/lista?sector=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }

    /**
     * @group riegoBuscarSector
     */
    public function testBuscarFechasTexto()
    {
        $this->visit('sector/riego/lista?sector=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }

    /**
     * @group riegoBuscarSector
     */
    public function testBuscarSectorTexto()
    {
        $this->visit('sector/riego/lista?sector=asdasd&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }

    /**
     * @group riegoBuscarSector
     */
    public function testBuscarSectorInexistente(){
        $this->visit('sector/riego/lista?sector=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }


    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group riegoCrearSector

    /*Unidad*/
    /**
     * @group riegoCrearSector
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'sector/riego/crear');
        $this->assertEquals(200, $response->status());
    }


////////////////////////////////////////////////MODIFICAR/////////////////////////////////////////////////////////////////

//para llamar a solo un grupo "phpunit --group riegoModificarSector"

    /*Unidad*/
    /**
     * @group riegoModificarSector
     */
    public function testRutaModificar(){
        $response = $this->call('GET', 'sector/riego/modificar/12');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group riegoModificarSector
     */
    public function testModificarIdIncorrecto(){
        $response = $this->call('GET', 'sector/riego/modificar/120');
        $this->assertEquals(404, $response->status());
    }

////////////////////////////////////////////////CONSULTAR/////////////////////////////////////////////////////////

//para llamar a solo un grupo "phpunit --group riegoConsultarSector"

    /*Unidad*/
    /**
     * @group riegoConsultarSector
     */
    public function testRutaConsultar(){
        $response = $this->call('GET', 'sector/riego/consultar/12');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @group riegoConsultarSector
     */
    public function testConsultarIdIncorrecto(){
        $response = $this->call('GET', 'sector/riego/consultar/120');
        $this->assertEquals(404, $response->status());
    }
}
