<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class siembraSectorTest extends TestCase
{
    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group siembraBuscarSector

    /*Unidad*/
    /**
     * @group siembraBuscarSector
     */
    public function testRutaBuscar(){
        $response = $this->call('GET', 'sector/siembra');
        $this->assertEquals(200, $response->status());
    }
    /*Integración*/

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarNoParametros(){
        $this->visit('sector/siembra')
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorCorrecto(){
        $this->visit('sector/siembra')
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarCultivoCorrecto(){
        $this->visit('sector/siembra')
            ->select(1,"cultivo")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarFechaCorrecto(){
        $this->visit('sector/siembra')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorFechaCorrecto(){
        $this->visit('sector/siembra')
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
        $this->visit('sector/siembra')
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
        $this->visit('sector/siembra')
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
        $this->visit('sector/siembra/lista?sector=&cultivo=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group siembraBuscarSector
     */
    public function testBuscarUnaFechaTexto(){
        $this->visit('sector/siembra/lista?sector=&cultivo=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarFechasTexto(){
        $this->visit('sector/siembra/lista?sector=&cultivo=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorTexto(){
        $this->visit('sector/siembra/lista?sector=asdasd&cultivo=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarCultivoTexto(){
        $this->visit('sector/siembra/lista?sector=&cultivo=zfzfdf&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarSectorInexistente(){
        $this->visit('sector/siembra/lista?sector=1000&cultivo=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group siembraBuscarSector
     */
    public function testBuscarCultivoInexistente(){
        $this->visit('sector/siembra/lista?sector=&cultivo=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }

    ////////////////////////////////////////////////CONSULTAR/////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group fertilizacionConsultarSector"

    /*Unidad*/
    /**
     * @group siembraConsultarSector
     */
    public function testRutaConsultar(){
        $response = $this->call('GET', 'sector/siembra/consultar/12');
        $this->assertEquals(200, $response->status());
    }

    /**
     * @group siembraConsultarSector
     */
    public function testConsultarIdIncorrecto(){
        $response = $this->call('GET', 'sector/siembra/consultar/120');
        $this->assertEquals(404, $response->status());
    }

    ////////////////////////////////////////////////MODIFICAR/////////////////////////////////////////////////////////////////

    //para llamar a solo un grupo "phpunit --group siembraModificarSector"

    /*Unidad*/
    /**
     * @group siembraModificarSector
     */
    public function testRutaModificar(){
        $response = $this->call('GET', 'sector/siembra/modificar/12');
        $this->assertEquals(200, $response->status());
    }
    /**
     * @group siembraModificarSector
     */
    public function testModificarIdIncorrecto(){
        $response = $this->call('GET', 'sector/siembra/modificar/120');
        $this->assertEquals(404, $response->status());
    }

    /**
     * @group siembraModificarSector
     */
    public function testModificarCorrecto(){
        $this->visit('sector/siembra/modificar/12')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Modificar')
            ->see("ha sido modificada");
    }
    /**
     * @group siembraModificarSector
     */

    public function testModificarNoSector(){
        $this->visit('sector/siembra/modificar/12')
            ->select("","sector")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Modificar')
            ->see("El campo sector es obligatorio");
    }
    /**
     * @group siembraModificarSector
     */
    public function testModificarNoMaquinaria(){
        $this->visit('sector/siembra/modificar/12')
            ->select(1,"sector")
            ->select("","cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Modificar')
            ->see("El campo cultivo es obligatorio");
    }

    /**
     * @group siembraModificarSector
     */

    public function testModificarNoFecha(){
        $this->visit('sector/siembra/modificar/12')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Modificar')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group siembraModificarSector
     */
    public function testModificarNoStatus(){
        $this->visit('sector/siembra/modificar/12')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Modificar')
            ->see("status es inválido.");
    }

    /**
     * @group siembraModificarSector
     */
    public function testModificarTipoInvalido(){
        $this->visit('sector/siembra/modificar/12')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("xxxx", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Modificar')
            ->see("tipo siembra es inválido.");
    }

    /**
     * @group siembraModificarSector
     */
    public function testModificarTemporadaInvalido(){
        $this->visit('sector/siembra/modificar/12')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("xxxx", "temporada")
            ->press('Modificar')
            ->see("temporada es inválido.");
    }

    /**
     * @group siembraModificarSector
     */
    public function testModificarFechaIncorrecta(){
        $this->visit('sector/siembra/modificar/12')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("asdas","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
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
        $response = $this->call('GET', 'sector/siembra/crear');
        $this->assertEquals(200, $response->status());
    }


    /*Integración*/

    /**
     * @group siembraCrearSector
     */
    public function testCrearCorrecto(){
        $this->visit('sector/siembra/crear')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Crear')
            ->see("La siembra ha sido agregada");
    }

    /**
     * @group siembraCrearSector
     */
    public function testCrearNoSector(){
        $this->visit('sector/siembra/crear')
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Crear')
            ->see("El campo sector es obligatorio");
    }


    /**
     * @group siembraCrearSector
     */
    public function testCrearNoCultivo(){
        $this->visit('sector/siembra/crear')
            ->select(1,"sector")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Crear')
            ->see("El campo cultivo es obligatorio");
    }

    /**
     * @group siembraCrearSector
     */
    public function testCrearNoFecha(){
        $this->visit('sector/siembra/crear')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Crear')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group siembraCrearSector
     */
    public function testCrearNoStatus(){
        $this->visit('sector/siembra/crear')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Crear')
            ->see("El campo status es obligatorio");
    }

    /**
     * @group siembraModificarSector
     */
    public function testCrearTipoInvalido(){
        $this->visit('sector/siembra/crear')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("xxxx", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Crear')
            ->see("tipo siembra es inválido.");
    }

    /**
     * @group siembraModificarSector
     */
    public function testCrearTemporadaInvalido(){
        $this->visit('sector/siembra/crear')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("18/02/2016","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("xxxx", "temporada")
            ->press('Crear')
            ->see("temporada es inválido.");
    }

    /**
     * @group siembraCrearSector
     */
    public function testCrearFechaIncorrecta(){
        $this->visit('sector/siembra/crear')
            ->select(1,"sector")
            ->select(1,"cultivo")
            ->type("asdas","fecha")
            ->type("Activo","status")
            ->type("Maquinaria", "tipoSiembra")
            ->type("lalala", "variedad")
            ->type("Primavera-Verano", "temporada")
            ->press('Crear')
            ->see("fecha no corresponde al formato d/m/Y");
    }

}




