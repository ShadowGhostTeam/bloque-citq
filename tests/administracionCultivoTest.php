<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class administracionCultivoTest extends TestCase
{


    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group administracionCultivoBuscar

    /*Unidad*/
    /**
     * @group administracionCultivoBuscar
     */
    public function testRutaBuscar(){
        $response = $this->call('GET', 'administracion/cultivos');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group administracionCultivoBuscar
     */
    public function testBuscarNoParametros(){
        $this->visit('administracion/cultivos')
            ->press('Buscar')
            ->see("Se encontraron");
    }

    public function testBuscarNombre(){
        $this->visit('administracion/cultivos')
            ->select(8,"cultivo")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group administracionCultivoCrear

    /*Unidad*/
    /**
     * @group administracionCultivoCrear
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'administracion/cultivos/crear');
        $this->assertEquals(200, $response->status());
    }


    /*Integración*/

    /**
     * @group administracionCultivoCrear
     */

    public function testCrearCorrecto(){
        $this->visit('administracion/cultivos/crear')
            ->type("prueba","nombre")
            ->type("prueba de desc","descripcion")
            ->press('Crear')
            ->see("El cultivo ha sido agregado");
    }

    /**
     * @group administracionCultivoCrear
     */
    public function testCrearNoNombre(){
        $this->visit('administracion/cultivos/crear')
            ->press('Crear')
            ->see("El campo nombre es obligatorio");
    }




////////////////////////////////////////////////MODIFICAR/////////////////////////////////////////////////////////////////

//para llamar a solo un grupo "phpunit --group administracionCultivoModificar"

    /*Unidad*/
    /**
     * @group administracionCultivoModificar
     */
    public function testRutaModificar(){
        $response = $this->call('GET', 'administracion/cultivos/modificar/12');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group administracionCultivoModificar
     */
    public function testModificarIdIncorrecto(){
        $response = $this->call('GET', 'administracion/cultivos/modificar/120');
        $this->assertEquals(404, $response->status());
    }
    /*Integración*/

    /**
     * @group administracionCultivoModificar
     */

    public function testModificarCorrecto(){
        $this->visit('administracion/cultivos/modificar/12')
            ->type("prueba","nombre")
            ->type("prueba de desc","descripcion")
            ->press('Modificar')
            ->see("ha sido modificado");
    }

    public function testModificarNoNombre(){
        $this->visit('administracion/cultivos/modificar/12')
            ->press('Modificar')
            ->see("El campo nombre es obligatorio");

    }


////////////////////////////////////////////////CONSULTAR/////////////////////////////////////////////////////////

//para llamar a solo un grupo "phpunit --group administracionCultivoConsultar"

    /*Unidad*/
    /**
     * @group administracionCultivoConsultar
     */
    public function testRutaConsultar(){
        $response = $this->call('GET', 'administracion/cultivos/consultar/12');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group administracionCultivoConsultar
     */
    public function testConsultarIdIncorrecto(){
        $response = $this->call('GET', 'administracion/cultivos/consultar/120');
        $this->assertEquals(404, $response->status());
    }
}
