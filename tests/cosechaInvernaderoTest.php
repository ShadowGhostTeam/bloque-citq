<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class cosechaInvernaderoTest extends TestCase
{
    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group cosechaCrearInvernadero

    /*Unidad*/
    /**
     * @group cosechaCrearInvernadero
     */
    public function testRutaCrear(){
        $user=User::find(1);
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
        $user=User::find(1);
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
        $user=User::find(1);
        $response = $this->call('GET', 'invernadero/cosecha/consultar/12');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group cosechaConsultarInvernadero
     */
    public function testConsultarIdIncorrecto(){
        $user=User::find(1);
        $response = $this->call('GET', 'invernadero/cosecha/consultar/120');
        $this->assertEquals(404, $response->status());
    }


    ////////////////////////////////////////////////BUSCAR///////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group cosechaBuscarInvernadero"

    /*Unidad*/
    /**
     * @group cosechaBuscarInvernadero
     */

    public function testRutaBuscar(){
        $user=User::find(1);
        $response = $this->call('GET', 'invernadero/cosecha');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group cosechaBuscarInvernadero
     */
    public function testBuscarInvernaderoCorrecto(){
        $user=User::find(1);
        $this->visit('invernadero/cosecha')
            ->select(1,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group cosechaBuscarInvernadero
     */
    public function testBuscarFechaCorrecto(){
        $user=User::find(1);
        $this->visit('invernadero/cosecha')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group cosechaBuscarInvernadero
     */
    public function testBuscarInvernaderoFechaCorrecto(){
        $user=User::find(1);
        $this->visit('invernadero/cosecha')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group cosechaBuscarInvernadero
     */
    public function testBuscarUnaFecha(){
        $user=User::find(1);
        $this->visit('invernadero/cosecha/lista?invernadero=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group cosechaBuscarInvernadero
     */
    public function testBuscarUnaFechaTexto(){
        $user=User::find(1);
        $this->visit('invernadero/cosecha/lista?invernadero=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group cosechaBuscarInvernadero
     */
    public function testBuscarFechasTexto(){
        $user=User::find(1);
        $this->visit('invernadero/cosecha/lista?invernadero=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group cosechaBuscarInvernadero
     */
    public function testBuscarInvernaderoTexto(){
        $user=User::find(1);
        $this->visit('invernadero/cosecha/lista?invernadero=asdasd&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group cosechaBuscarInvernadero
     */
    public function testBuscarInvernaderoInexistente(){
        $user=User::find(1);
        $this->visit('invernadero/cosecha/lista?invernadero=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }


}
