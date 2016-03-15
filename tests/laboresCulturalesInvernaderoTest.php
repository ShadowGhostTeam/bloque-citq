<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class laboresCulturalesInvernaderoTest extends TestCase
{
    ///////////////CREAR
    ///para llamar a un grupo phpunit --group laboresCulturalesModificar
    /*Unidad*/
    /**
     * @group laboresCulturalesCrear
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'invernadero/laboresCulturales/crear');
        $this->assertEquals(200, $response->status());
    }
    ///////////////MODIFICAR
    /*Unidad*/
    /**
     * @group laboresCulturalesModificar
     */
    public function testRutaModificar(){
        $response = $this->call('GET', 'invernadero/laboresCulturales/modificar/1');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @group laboresCulturalesModificar
     */
    public function testModificarIdIncorrecto(){
        $response = $this->call('GET', 'invernadero/laboresCulturales/modificar/120');
        $this->assertEquals(404, $response->status());
    }
<<<<<<< HEAD
=======
    //////////////Consultar
    /*Unidad*/
    /**
     * @group laboresCulturalesConsultar
     */
    public function testRutaConsultar(){
        $response = $this->call('GET', 'invernadero/laboresCulturales/consultar/1');
        $this->assertEquals(200, $response->status());
    }

    /*Unidad*/
    /**
     * @group laboresCulturalesConsultar
     */
    public function testRutaConsultarIdIncorrecto(){
        $response = $this->call('GET', 'invernadero/laboresCulturales/consultar/120');
        $this->assertEquals(404, $response->status());
    }

    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group laboresCulturalesBuscarInvernadero

    /*Unidad*/
    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testRutaBuscar(){
        $response = $this->call('GET', 'invernadero/laboresCulturales');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarNoParametros(){
        $this->visit('invernadero/laboresCulturales')
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarInvernaderoCorrecto(){
        $this->visit('invernadero/laboresCulturales')
            ->select(1,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarFuenteCorrecto(){
        $this->visit('invernadero/laboresCulturales')
            ->select("Despuntes","actividad")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarFechaCorrecto(){
        $this->visit('invernadero/laboresCulturales')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarInvernaderoFechaCorrecto(){
        $this->visit('invernadero/laboresCulturales')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarFuenteFechaCorrecto(){
        $this->visit('invernadero/laboresCulturales')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select("Despuntes","actividad")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarInvernaderoFuenteFechaCorrecto(){
        $this->visit('invernadero/laboresCulturales')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"invernadero")
            ->select("Despuntes","actividad")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarUnaFecha(){
        $this->visit('invernadero/laboresCulturales/lista?invernadero=&actividad=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarUnaFechaTexto(){
        $this->visit('invernadero/laboresCulturales/lista?invernadero=&actividad=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarFechasTexto(){
        $this->visit('invernadero/laboresCulturales/lista?invernadero=&actividad=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarInvernaderoTexto(){
        $this->visit('invernadero/laboresCulturales/lista?invernadero=asdasd&actividad=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarFuenteTexto(){
        $this->visit('invernadero/laboresCulturales/lista?invernadero=&actividad=zfzfdf&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarInvernaderoInexistente(){
        $this->visit('invernadero/laboresCulturales/lista?invernadero=1000&actividad=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group laboresCulturalesBuscarInvernadero
     */
    public function testBuscarFuenteInexistente(){
        $this->visit('invernadero/laboresCulturales/lista?invernadero=&actividad=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }


>>>>>>> 30580a85a09145dad180356001e18a9bf0cd9a57
}
