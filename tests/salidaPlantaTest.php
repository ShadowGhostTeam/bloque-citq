<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class salidaPlantaTest extends TestCase
{
    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group aplicacionesBuscarPlantula

    /*Unidad*/
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testRutaBuscar(){
        $response = $this->call('GET', 'plantula/aplicaciones');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarNoParametros(){
        $this->visit('plantula/aplicaciones')
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarInvernaderoCorrecto(){
        $this->visit('plantula/aplicaciones')
            ->select(8,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarAplicacionCorrecto(){
        $this->visit('plantula/aplicaciones')
            ->select("Fungicida","aplicacion")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarTipoAplicacionCorrecto(){
        $this->visit('plantula/aplicaciones')
            ->select("Sistema de riego","tipoAplicacion")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarFechaCorrecto(){
        $this->visit('plantula/aplicaciones')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarInvernaderoFechaCorrecto(){
        $this->visit('plantula/aplicaciones')
            ->type("19/11/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(8,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarAplicacionFechaCorrecto(){
        $this->visit('plantula/aplicaciones')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select("Fungicida","aplicacion")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscaraTipoAplicacionFechaCorrecto(){
        $this->visit('plantula/aplicaciones')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select("Sistema de riego","tipoAplicacion")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarInvernaderoAplicacionFechaCorrecto(){
        $this->visit('plantula/aplicaciones')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(8,"invernadero")
            ->select("Fungicida","aplicacion")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarInvernaderoTipoAplicacionFechaCorrecto(){
        $this->visit('plantula/aplicaciones')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(8,"invernadero")
            ->select("Sistema de riego","tipoAplicacion")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarAplicacionTipoFechaCorrecto(){
        $this->visit('plantula/aplicaciones')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select("Fungicida","aplicacion")
            ->select("Sistema de riego","tipoAplicacion")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarInvernaderoAplicacionTipoFechaCorrecto(){
        $this->visit('plantula/aplicaciones')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(8,"invernadero")
            ->select("Fungicida","aplicacion")
            ->select("Sistema de riego", "tipoAplicacion")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarUnaFecha(){
        $this->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=&tipoAplicacion=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarUnaFechaTexto(){
        $this->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=&tipoAplicacion=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarFechasTexto(){
        $this->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=&tipoAplicacion=&=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarInvernaderoTexto(){
        $this->visit('plantula/aplicaciones/lista?invernadero=asdasd&aplicacion=&tipoAplicacion=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarAplicacionTexto(){
        $this->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=zfzfdf&tipoAplicacion=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarTipoAplicacionTexto(){
        $this->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=&tipoAplicacion=zfzfdf&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarInvernaderoInexistente(){
        $this->visit('plantula/aplicaciones/lista?invernadero=1000&aplicacion=&tipoAplicacion=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarAplicacionInexistente(){
        $this->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=1000&tipoAplicacion=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarTipoAplicacionInexistente(){
        $this->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=&tipoAplicacion=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }


    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group aplicacionCrearPlantula

    /*Unidad*/
    /**
     * @group aplicacionCrearPlantula
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'plantula/aplicaciones/crear');
        $this->assertEquals(200, $response->status());
    }

    ///////////////////////////////////////CONSULTAR///////////////////////////////////////////////////////
    //para llamar a solo un grupo phpunit --group aplicacionConsultarPlantula

    /*Unidad*/
    /**
     * @group aplicacionConsultarPlantula
     */
    public function testRutaConsultar(){
        $response = $this->call('GET', 'plantula/aplicaciones/consultar/1');
        $this->assertEquals(200, $response->status());
    }

    /*Unidad*/
    /**
     * @group aplicacionConsultarPlantula
     */
    public function testRutaConsultarIdIncorrecto(){
        $response = $this->call('GET', 'plantula/aplicaciones/consultar/120');
        $this->assertEquals(404, $response->status());
    }

    /////////////////////////////////////MODIFICAR//////////////////////////////////////////////////////////////
    //para llamar a solo un grupo phpunit --group aplicacionModificarPlantula

    /*Unidad*/
    /**
     * @group aplicacionModificarPlantula
     */
    public function testRutaModificar(){
        $response = $this->call('GET', 'plantula/aplicaciones/modificar/1');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @group aplicacionModificarPlantula
     */
    public function testModificarIdIncorrecto(){
        $response = $this->call('GET', 'plantula/aplicaciones/modificar/120');
        $this->assertEquals(404, $response->status());
    }

}
