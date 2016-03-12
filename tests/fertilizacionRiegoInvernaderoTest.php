<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class fertilizacionRiegoInvernaderoTest extends TestCase
{
    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group fertilizacionRiegoBuscarInvernadero

    /*Unidad*/
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testRutaBuscar(){
        $response = $this->call('GET', 'invernadero/fertilizacionRiego');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarNoParametros(){
        $this->visit('invernadero/fertilizacionRiego')
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarInvernaderoCorrecto(){
        $this->visit('invernadero/fertilizacionRiego')
            ->select(1,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarSiembraTCorrecto(){
        $this->visit('invernadero/fertilizacionRiego')
            ->select(1,"siembraT")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarFechaCorrecto(){
        $this->visit('invernadero/fertilizacionRiego')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarInvernaderoFechaCorrecto(){
        $this->visit('invernadero/fertilizacionRiego')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarFuenteFechaCorrecto(){
        $this->visit('invernadero/fertilizacionRiego')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"siembraT")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarInvernaderoSiembraTFechaCorrecto(){
        $this->visit('invernadero/fertilizacionRiego')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"invernadero")
            ->select(1,"siembraT")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarUnaFecha(){
        $this->visit('invernadero/fertilizacionRiego/lista?invernadero=&siembraT=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarUnaFechaTexto(){
        $this->visit('invernadero/fertilizacionRiego/lista?invernadero=&siembraT=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarFechasTexto(){
        $this->visit('invernadero/fertilizacionRiego/lista?invernadero=&siembraT=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarInvernaderoTexto(){
        $this->visit('invernadero/fertilizacionRiego/lista?invernadero=asdasd&siembraT=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarSiembraTTexto(){
        $this->visit('invernadero/fertilizacionRiego/lista?invernadero=&siembraT=zfzfdf&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarInvernaderoInexistente(){
        $this->visit('invernadero/fertilizacionRiego/lista?invernadero=1000&siembraT=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarSiembraTInexistente(){
        $this->visit('invernadero/fertilizacionRiego/lista?invernadero=&siembraT=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }


    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group fertilizacionRiegoCrearInvernadero

    /*Unidad*/
    /**
     * @group fertilizacionRiegoCrearInvernadero
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'invernadero/fertilizacionRiego/crear');
        $this->assertEquals(200, $response->status());
    }

}
