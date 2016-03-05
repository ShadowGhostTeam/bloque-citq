<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class siembraSectorTest extends TestCase
{
    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group siembraBuscarSector

    /*Unidad*/
    /**
     * @group siembraBuscarSector
     */
    public function testRutaBuscar(){
        $response = $this->call('GET', 'sector/siembra');
        $this->assertEquals(200, $response->status());
    }
    /*Integración*/

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarNoParametros(){
        $this->visit('sector/siembra')
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorCorrecto(){
        $this->visit('sector/siembra')
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarCultivoCorrecto(){
        $this->visit('sector/siembra')
            ->select(1,"cultivo")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarFechaCorrecto(){
        $this->visit('sector/siembra')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorFechaCorrecto(){
        $this->visit('sector/siembra')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarCultivoFechaCorrecto(){
        $this->visit('sector/siembra')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"cultivo")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorCultivoFechaCorrecto(){
        $this->visit('sector/siembra')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarUnaFecha(){
        $this->visit('sector/siembra/lista?sector=&cultivo=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarUnaFechaTexto(){
        $this->visit('sector/siembra/lista?sector=&cultivo=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarFechasTexto(){
        $this->visit('sector/siembra/lista?sector=&cultivo=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorTexto(){
        $this->visit('sector/siembra/lista?sector=asdasd&cultivo=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarCultivoTexto(){
        $this->visit('sector/siembra/lista?sector=&cultivo=zfzfdf&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorInexistente(){
        $this->visit('sector/siembra/lista?sector=1000&cultivo=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarCultivoInexistente(){
        $this->visit('sector/siembra/lista?sector=&cultivo=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }

    ////////////////////////////////////////////////CONSULTAR/////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group fertilizacionConsultarSector"

    /*Unidad*/
    /**
     * @group siembraConsultarSector
     */
    public function testRutaConsultar(){
        $response = $this->call('GET', 'sector/siembra/consultar/12');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @group siembraConsultarSector
     */
    public function testConsultarIdIncorrecto(){
        $response = $this->call('GET', 'sector/siembra/consultar/120');
        $this->assertEquals(404, $response->status());
    }

}



