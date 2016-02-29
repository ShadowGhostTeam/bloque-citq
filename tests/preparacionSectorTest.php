<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class preparacionSectorTest extends TestCase
{


    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group preparacionBuscarSector

    /*Unidad*/
    /**
     * @group preparacionBuscarSector
     */
    public function testRutaBuscar(){
        $response = $this->call('GET', 'sector/preparacion');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarNoParametros(){
        $this->visit('sector/preparacion')
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarSectorCorrecto(){
        $this->visit('sector/preparacion')
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarMaquinariaCorrecto(){
        $this->visit('sector/preparacion')
            ->select(1,"maquinaria")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarFechaCorrecto(){
        $this->visit('sector/preparacion')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarSectorFechaCorrecto(){
        $this->visit('sector/preparacion')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarMaquinariaFechaCorrecto(){
        $this->visit('sector/preparacion')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarSectorMaquinariaFechaCorrecto(){
        $this->visit('sector/preparacion')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"sector")
            ->select(1,"maquinaria")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarUnaFecha(){
        $this->visit('sector/preparacion/lista?sector=&maquinaria=&fechaInicio=&fechaFin=29%2F02%2F2016')
              ->see("No se encontraron resultados");
    }

    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarUnaFechaTexto(){
        $this->visit('sector/preparacion/lista?sector=&maquinaria=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarFechasTexto(){
        $this->visit('sector/preparacion/lista?sector=&maquinaria=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarSectorTexto(){
        $this->visit('sector/preparacion/lista?sector=asdasd&maquinaria=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarMaquinariaTexto(){
        $this->visit('sector/preparacion/lista?sector=&maquinaria=zfzfdf&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarSectorInexistente(){
        $this->visit('sector/preparacion/lista?sector=1000&maquinaria=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group preparacionBuscarSector
     */
    public function testBuscarMaquinariaInexistente(){
        $this->visit('sector/preparacion/lista?sector=&maquinaria=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }







    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group preparacionCrearSector

    /*Unidad*/
    /**
     * @group preparacionCrearSector
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'sector/preparacion/crear');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group preparacionCrearSector
     */

    public function testCrearCorrecto(){
        $this->visit('sector/preparacion/crear')
            ->select(1,"sector")
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Crear')
            ->see("La preparacion ha sido agregada");
    }

    /**
     * @group preparacionCrearSector
     */
    public function testCrearNoSector(){
        $this->visit('sector/preparacion/crear')
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Crear')
            ->see("El campo sector es obligatorio");
    }


    /**
     * @group preparacionCrearSector
     */

    public function testCrearNoMaquinaria(){
        $this->visit('sector/preparacion/crear')
            ->type("2","numPasadas")
            ->press('Crear')
            ->see("El campo maquinaria es obligatorio");
    }

    /**
     * @group preparacionCrearSector
     */

    public function testCrearNoFecha(){
        $this->visit('sector/preparacion/crear')
            ->select(1,"maquinaria")
            ->type("2","numPasadas")
            ->press('Crear')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group preparacionCrearSector
     */
    public function testCrearNoPasadas(){
        $this->visit('sector/preparacion/crear')
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("El campo número de pasadas es obligatorio");
    }

    /**
     * @group preparacionCrearSector
     */
    public function testCrearPasadasNegativo(){
        $this->visit('sector/preparacion/crear')
            ->select(1,"maquinaria")
            ->type("-1","numPasadas")
            ->press('Crear')
            ->see("El tamaño de número de pasadas debe ser de al menos 0");
    }
    /**
     * @group preparacionCrearSector
     */
    public function testCrearFechaIncorrecta(){
        $this->visit('sector/preparacion/crear')
            ->select(1,"maquinaria")
            ->type("asdas","fecha")
            ->press('Crear')
            ->see("fecha no corresponde al formato d/m/Y");
    }



////////////////////////////////////////////////MODIFICAR/////////////////////////////////////////////////////////////////

//para llamar a solo un grupo phpunit --group preparacionCrearSector

    /*Unidad*/
    /**
     * @group preparacionModificarSector
     */
    public function testRutaModificar(){
        $response = $this->call('GET', 'sector/preparacion/modificar/12');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group preparacionModificarSector
     */

    public function testModificarCorrecto(){
        $this->visit('sector/preparacion/modificar/12')
            ->select(1,"sector")
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Modificar')
            ->see("ha sido modificada");
    }
    /**
     * @group preparacionModificarSector
     */

    public function testModificarNoSector(){
        $this->visit('sector/preparacion/modificar/12')
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Modificar')
            ->see("El campo sector es obligatorio");
    }

    public function testModificarNoMaquinaria(){
        $this->visit('sector/preparacion/modificar/12')
            ->select(1,"sector")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Modificar')
            ->see("El campo maquinaria es obligatorio");
    }

    /**
     * @group preparacionModificarSector
     */

    public function testModificarNoFecha(){
        $this->visit('sector/preparacion/modificar/12')
            ->select(1,"sector")
            ->select(1,"maquinaria")
            ->type("2","numPasadas")
            ->press('Modificar')
            ->see("El campo fecha es obligatorio");
    }
    /**
     * @group preparacionModificarSector
     */

    public function testModificarNoPasadas(){
        $this->visit('sector/preparacion/modificar/12')
            ->select(1,"sector")
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->press('Modificar')
            ->see("El campo número de pasadas es obligatorio");

    }

    /**
     * @group preparacionModificarSector
     */
    public function testModificarPasadasNegativo(){
        $this->visit('sector/preparacion/modificar/12')
            ->select(1,"maquinaria")
            ->type("-1","numPasadas")
            ->press('Modificar')
            ->see("El tamaño de número de pasadas debe ser de al menos 0");
    }
    /**
     * @group preparacionModificarSector
     */
    public function testModificarFechaIncorrecta(){
        $this->visit('sector/preparacion/modificar/12')
            ->select(1,"maquinaria")
            ->type("asdas","fecha")
            ->press('Modificar')
            ->see("fecha no corresponde al formato d/m/Y");
    }
    /**
     * @group preparacionModificarSector
     */
    public function testModificarIdIncorrecto(){
        $this->visit('sector/preparacion/modificar/120')
            ->see("404");
    }



}
