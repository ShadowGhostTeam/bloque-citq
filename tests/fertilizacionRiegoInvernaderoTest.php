<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class fertilizacionRiegoInvernaderoTest extends TestCase
{
    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group fertilizacionRiegoBuscarInvernadero

    /*Unidad*/
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testRutaBuscar(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego')
            ->seePageIs('invernadero/fertilizacionRiego');
    }

    /*Integración*/

    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarNoParametros(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego')
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarInvernaderoCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego')
            ->select(1,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarEtapaCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego')
            ->select("Emergencia","etapaFenologica")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarFechaCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarInvernaderoFechaCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego')
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
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select("Emergencia","etapaFenologica")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarInvernaderoetapaFenologicaFechaCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"invernadero")
            ->select("Emergencia","etapaFenologica")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarUnaFecha(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego/lista?invernadero=&etapaFenologica=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarUnaFechaTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego/lista?invernadero=&etapaFenologica=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarFechasTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego/lista?invernadero=&etapaFenologica=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarInvernaderoTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego/lista?invernadero=asdasd&etapaFenologica=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscaretapaFenologicaTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego/lista?invernadero=&etapaFenologica=zfzfdf&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscarInvernaderoInexistente(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego/lista?invernadero=1000&etapaFenologica=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionRiegoBuscarInvernadero
     */
    public function testBuscaretapaFenologicaInexistente(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego/lista?invernadero=&etapaFenologica=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }


    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group fertilizacionRiegoCrearInvernadero

    /*Unidad*/
    /**
     * @group fertilizacionRiegoCrearInvernadero
     */
    public function testRutaCrear(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego/crear')
            ->seePageIs('invernadero/fertilizacionRiego/crear');
    }

    ///////////////////////////////////////CONSULTAR///////////////////////////////////////////////////////
    //para llamar a solo un grupo phpunit --group fertilizacionRiegoConsultarInvernadero

    /*Unidad*/
    /**
     * @group fertilizacionRiegoConsultarInvernadero
     */
    public function testRutaConsultar(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego/consultar/1')
            ->seePageIs('invernadero/fertilizacionRiego/consultar/1');
    }


    /////////////////////////////////////MODIFICAR//////////////////////////////////////////////////////////////
    //para llamar a solo un grupo phpunit --group fertilizacionRiegoModificarInvernadero

    /*Unidad*/
    /**
     * @group fertilizacionRiegoModificarInvernadero
     */
    public function testRutaModificar(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('invernadero/fertilizacionRiego/modificar/1')
            ->seePageIs('invernadero/fertilizacionRiego/modificar/1');
    }

}
