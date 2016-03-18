<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class siembraInvernaderoTest extends TestCase
{
    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group siembraBuscarInvernadero

    /*Unidad*/
    /**
     * @group siembraBuscarInvernadero
     */
    public function testRutaBuscar(){
        $response = $this->call('GET', 'invernadero/siembra');
        $this->assertEquals(200, $response->status());
    }
    /*Integración*/

    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarNoParametros(){
        $this->visit('invernadero/siembra')
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarInvernaderoCorrecto(){
        $this->visit('invernadero/siembra')
            ->select(1,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarCultivoCorrecto(){
        $this->visit('invernadero/siembra')
            ->select(1,"cultivo")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarFechaCorrecto(){
        $this->visit('invernadero/siembra')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarInvernaderoFechaCorrecto(){
        $this->visit('invernadero/siembra')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"invernadero")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarCultivoFechaCorrecto(){
        $this->visit('invernadero/siembra')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"cultivo")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarInvernaderoCultivoFechaCorrecto(){
        $this->visit('invernadero/siembra')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"invernadero")
            ->select(1,"cultivo")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarUnaFecha(){
        $this->visit('invernadero/siembra/lista?invernadero=&cultivo=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarUnaFechaTexto(){
        $this->visit('invernadero/siembra/lista?invernadero=&cultivo=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarFechasTexto(){
        $this->visit('invernadero/siembra/lista?invernadero=&cultivo=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarInvernaderoTexto(){
        $this->visit('invernadero/siembra/lista?invernadero=asdasd&cultivo=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarCultivoTexto(){
        $this->visit('invernadero/siembra/lista?invernadero=&cultivo=zfzfdf&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarInvernaderoInexistente(){
        $this->visit('invernadero/siembra/lista?invernadero=1000&cultivo=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarInvernadero
     */
    public function testBuscarCultivoInexistente(){
        $this->visit('invernadero/siembra/lista?invernadero=&cultivo=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }

    ////////////////////////////////////////////////CONSULTAR/////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group siembraConsultarInvernadero"

    /*Unidad*/
    /**
     * @group siembraConsultarInvernadero
     */
    public function testRutaConsultar(){
        $response = $this->call('GET', 'invernadero/siembra/consultar/12');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @group siembraConsultarInvernadero
     */
    public function testConsultarIdIncorrecto(){
        $response = $this->call('GET', 'invernadero/siembra/consultar/120');
        $this->assertEquals(404, $response->status());
    }

    ////////////////////////////////////////////////MODIFICAR/////////////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group siembraModificarInvernadero"

    /*Unidad*/
    /**
     * @group siembraModificarInvernadero
     */
    public function testRutaModificar(){
        $response = $this->call('GET', 'invernadero/siembra/modificar/12');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group siembraModificarInvernadero
     */
    public function testModificarIdIncorrecto(){
        $response = $this->call('GET', 'invernadero/siembra/modificar/120');
        $this->assertEquals(404, $response->status());
    }

    /**
     * @group siembraModificarInvernadero
     */
    public function testModificarCorrecto(){
        $this->visit('invernadero/siembra/modificar/12')
            ->select(1,"invernadero")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->press('Modificar')
            ->see("ha sido modificada");
    }
    /**
     * @group siembraModificarInvernadero
     */

    public function testModificarNoInvernadero(){
        $this->visit('invernadero/siembra/modificar/12')
            ->select("","invernadero")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->press('Modificar')
            ->see("El campo invernadero es obligatorio");
    }
    /**
     * @group siembraModificarInvernadero
     */
    public function testModificarNoCultivo(){
        $this->visit('invernadero/siembra/modificar/12')
            ->select(1,"invernadero")
            ->select("","cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->press('Modificar')
            ->see("El campo cultivo es obligatorio");
    }

    /**
     * @group siembraModificarInvernadero
     */

    public function testModificarNoFecha(){
        $this->visit('invernadero/siembra/modificar/12')
            ->select(1,"invernadero")
            ->select(1,"cultivo")
            ->type("","fecha")
            ->type("Activo","status")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->press('Modificar')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group siembraModificarInvernadero
     */
    public function testModificarFechaIncorrecta(){
        $this->visit('invernadero/siembra/modificar/12')
            ->select(1,"invernadero")
            ->select(1,"cultivo")
            ->type("asdas","fecha")
            ->type("Activo","status")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->press('Modificar')
            ->see("fecha no corresponde al formato d/m/Y");
    }

    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group siembraCrearInvernadero

    /*Unidad*/
    /**
     * @group siembraCrearInvernadero
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'invernadero/siembra/crear');
        $this->assertEquals(200, $response->status());
    }


    /*Integración*/

    /**
     * @group siembraCrearInvernadero
     */
    public function testCrearCorrecto(){
        $this->visit('invernadero/siembra/crear')
            ->select(1,"invernadero")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->press('Crear')
            ->see("La siembra ha sido agregada");
    }

    /**
     * @group siembraCrearInvernadero
     */
    public function testCrearNoInvernadero(){
        $this->visit('invernadero/siembra/crear')
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->press('Crear')
            ->see("El campo invernadero es obligatorio");
    }


    /**
     * @group siembraCrearInvernadero
     */
    public function testCrearNoCultivo(){
        $this->visit('invernadero/siembra/crear')
            ->select(1,"invernadero")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->press('Crear')
            ->see("El campo cultivo es obligatorio");
    }

    /**
     * @group siembraCrearInvernadero
     */
    public function testCrearNoFecha(){
        $this->visit('invernadero/siembra/crear')
            ->select(1,"invernadero")
            ->select(1,"cultivo")
            ->type("Activo","status")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->press('Crear')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group siembraCrearInvernadero
     */
    public function testCrearFechaIncorrecta(){
        $this->visit('invernadero/siembra/crear')
            ->select(1,"invernadero")
            ->select(1,"cultivo")
            ->type("asdas","fecha")
            ->type("Activo","status")
            ->type("lalala", "variedad")
            ->type("hola", "comentario")
            ->press('Crear')
            ->see("fecha no corresponde al formato d/m/Y");
    }

}




