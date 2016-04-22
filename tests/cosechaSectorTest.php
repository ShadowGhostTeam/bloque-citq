<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class cosechaSectorTest extends TestCase
{
    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group cosechaCrearSector

    /*Unidad*/
    /**
     * @group cosechaCrearSector
     */
    public function testRutaCrear(){
        $user=User::find(1);
        $response = $this->call('GET', 'sector/cosecha/crear');
        $this->assertEquals(200, $response->status());
    }

    ////////////////////////////////////////////////MODIFICAR/////////////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group cosechaModificarSector"

    /*Unidad*/
    /**
     * @group cosechaModificarSector
     */
    public function testRutaModificar(){
        $user=User::find(1);
        $response = $this->call('GET', 'sector/cosecha/modificar/12');
        $this->assertEquals(200, $response->status());
    }

    ////////////////////////////////////////////////CONSULTAR/////////////////////////////////////////////////////////

//para llamar a solo un grupo "phpunit --group cosechaConsultarSector"

    /*Unidad*/
    /**
     * @group cosechaConsultarSector
     */
    public function testRutaConsultar(){
        $user=User::find(1);
        $response = $this->call('GET', 'sector/cosecha/consultar/12');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group cosechaConsultarSector
     */
    public function testConsultarIdIncorrecto(){
        $user=User::find(1);
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
        $user=User::find(1);
        $response = $this->call('GET', 'sector/cosecha');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarSectorCorrecto(){
        $user=User::find(1);
        $this->visit('sector/cosecha')
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarFechaCorrecto(){
        $user=User::find(1);
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
        $user=User::find(1);
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
        $user=User::find(1);
        $this->visit('sector/cosecha/lista?sector=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarUnaFechaTexto(){
        $user=User::find(1);
        $this->visit('sector/cosecha/lista?sector=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarFechasTexto(){
        $user=User::find(1);
        $this->visit('sector/cosecha/lista?sector=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarSectorTexto(){
        $user=User::find(1);
        $this->visit('sector/cosecha/lista?sector=asdasd&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group cosechaBuscarSector
     */
    public function testBuscarSectorInexistente(){
        $user=User::find(1);
        $this->visit('sector/cosecha/lista?sector=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }

}


