<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;


class siembraSectorTest extends TestCase
{
    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group siembraBuscarSector

    /*Unidad*/
    /**
     * @group siembraBuscarSector
     */
    public function testRutaBuscar(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra')
            ->seePageIs('sector/siembra');
    }
    /*Integración*/

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarNoParametros(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra')
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra')
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarCultivoCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra')
            ->select(1,"cultivo")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarFechaCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorFechaCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra')
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
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra')
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
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra')
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
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/lista?sector=&cultivo=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarUnaFechaTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/lista?sector=&cultivo=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarFechasTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/lista?sector=&cultivo=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/lista?sector=asdasd&cultivo=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarCultivoTexto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/lista?sector=&cultivo=zfzfdf&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorInexistente(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/lista?sector=1000&cultivo=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarCultivoInexistente(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/lista?sector=&cultivo=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }

    ////////////////////////////////////////////////CONSULTAR/////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group siembraConsultarSector"

    /*Unidad*/
    /**
     * @group siembraConsultarSector
     */
    public function testRutaConsultar(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/consultar/12')
            ->seePageIs('sector/siembra/consultar/12');
    }

    ////////////////////////////////////////////////MODIFICAR/////////////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group siembraModificarSector"

    /*Unidad*/
    /**
     * @group siembraModificarSector
     */
    public function testRutaModificar(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/modificar/12')
            ->seePageIs('sector/siembra/modificar/12');
    }

    /**
     * @group siembraModificarSector
     */
    public function testModificarCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/modificar/12')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->type("Primavera-Verano", "temporada")
            ->press('Modificar')
            ->see("ha sido modificada");
    }
    /**
     * @group siembraModificarSector
     */

    public function testModificarNoSector(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/modificar/12')
            ->select("","sector")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->type("Primavera-Verano", "temporada")
            ->press('Modificar')
            ->see("El campo sector es obligatorio");
    }
    /**
     * @group siembraModificarSector
     */
    public function testModificarNoCultivo(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/modificar/12')
            ->select(1,"sector")
            ->select("","cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->type("Primavera-Verano", "temporada")
            ->press('Modificar')
            ->see("El campo cultivo es obligatorio");
    }

    /**
     * @group siembraModificarSector
     */

    public function testModificarNoFecha(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/modificar/12')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->type("Primavera-Verano", "temporada")
            ->press('Modificar')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group siembraModificarSector
     */
    public function testModificarFechaIncorrecta(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/modificar/12')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("asdas","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->type("Primavera-Verano", "temporada")
            ->press('Modificar')
            ->see("fecha no corresponde al formato d/m/Y");
    }

    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group siembraCrearSector

    /*Unidad*/
    /**
     * @group siembraCrearSector
     */
    public function testRutaCrear(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/crear')
            ->seePageIs('sector/siembra/crear');
    }


    /*Integración*/

    /**
     * @group siembraCrearSector
     */
    public function testCrearCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/crear')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->type("Primavera-Verano", "temporada")
            ->press('Crear')
            ->see("La siembra ha sido agregada");
    }

    /**
     * @group siembraCrearSector
     */
    public function testCrearNoSector(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/crear')
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->type("Primavera-Verano", "temporada")
            ->press('Crear')
            ->see("El campo sector es obligatorio");
    }


    /**
     * @group siembraCrearSector
     */
    public function testCrearNoCultivo(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/crear')
            ->select(1,"sector")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->type("Primavera-Verano", "temporada")
            ->press('Crear')
            ->see("El campo cultivo es obligatorio");
    }

    /**
     * @group siembraCrearSector
     */
    public function testCrearNoFecha(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/crear')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->type("Primavera-Verano", "temporada")
            ->press('Crear')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group siembraCrearSector
     */
    public function testCrearFechaIncorrecta(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('sector/siembra/crear')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("asdas","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->type("Primavera-Verano", "temporada")
            ->press('Crear')
            ->see("fecha no corresponde al formato d/m/Y");
    }

}




