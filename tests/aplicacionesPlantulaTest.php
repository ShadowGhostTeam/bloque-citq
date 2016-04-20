<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class aplicacionesPlantulaTest extends TestCase
{
    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group aplicacionesBuscarPlantula

    /*Unidad*/
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testRutaBuscar(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
            ->seePageIs('plantula/aplicaciones');
    }

    /*Integración*/

    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarNoParametros(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarInvernaderoCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
            ->select(8,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarAplicacionCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
            ->select("Fungicida","aplicacion")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarTipoAplicacionCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
            ->select("Sistema de riego","tipoAplicacion")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarFechaCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarInvernaderoFechaCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
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
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
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
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
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
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
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
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
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
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
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
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones')
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
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=&tipoAplicacion=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarUnaFechaTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=&tipoAplicacion=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarFechasTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=&tipoAplicacion=&=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarInvernaderoTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones/lista?invernadero=asdasd&aplicacion=&tipoAplicacion=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarAplicacionTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=zfzfdf&tipoAplicacion=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarTipoAplicacionTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=&tipoAplicacion=zfzfdf&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarInvernaderoInexistente(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones/lista?invernadero=1000&aplicacion=&tipoAplicacion=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarAplicacionInexistente(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=1000&tipoAplicacion=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group aplicacionesBuscarPlantula
     */
    public function testBuscarTipoAplicacionInexistente(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones/lista?invernadero=&aplicacion=&tipoAplicacion=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }


    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group aplicacionCrearPlantula

    /*Unidad*/
    /**
     * @group aplicacionCrearPlantula
     */
    public function testRutaCrear(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones/crear')
            ->seePageIs('plantula/aplicaciones/crear');
    }

    ///////////////////////////////////////CONSULTAR///////////////////////////////////////////////////////
    //para llamar a solo un grupo phpunit --group aplicacionConsultarPlantula

    /*Unidad*/
    /**
     * @group aplicacionConsultarPlantula
     */
    public function testRutaConsultar(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones/consultar/1')
            ->seePageIs('plantula/aplicaciones/consultar/1');
    }


    /////////////////////////////////////MODIFICAR//////////////////////////////////////////////////////////////
    //para llamar a solo un grupo phpunit --group aplicacionModificarPlantula

    /*Unidad*/
    /**
     * @group aplicacionModificarPlantula
     */
    public function testRutaModificar(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('plantula/aplicaciones/modificar/1')
            ->seePageIs('plantula/aplicaciones/modificar/1');
    }

}
