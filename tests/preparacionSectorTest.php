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







    ///////////////////////////////////////////////////////////////////////

    /**
     * A basic test example.
     *
     * @return void
     */
    /**
     * @group preparacionSector
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testNoSector(){
        $this->visit('sector/preparacion/crear')
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Crear')
            ->see("El campo sector es obligatorio");
    }


    /**
     * @group preparacionSector
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testNoMaquinaria(){
        $this->visit('sector/preparacion/crear')
            ->type("2","numPasadas")
            ->press('Crear')
            ->see("El campo maquinaria es obligatorio");
    }

    /**
     * @group preparacionSector
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testNoFecha(){
        $this->visit('sector/preparacion/crear')
            ->select(1,"maquinaria")
            ->type("2","numPasadas")
            ->press('Crear')
            ->see("El campo fecha es obligatorio");
    }

    /**
     * @group preparacionSector
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testNoPasadas(){
        $this->visit('sector/preparacion/crear')
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->press('Crear')
            ->see("El campo número de pasadas es obligatorio");
    }


    /**
     * @group preparacionSector
     */
    //para llamar a solo un grupo phpunit --group preparacionSector
    public function testCorrecto(){
        $this->visit('sector/preparacion/crear')
            ->select(1,"sector")
            ->select(1,"maquinaria")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Crear')
            ->see("La preparacion ha sido agregada");
    }


    //////////////////////////////UNIDAD/////////////////////////////

    /**
     * @group preparacionSector
     */
    public function testRutaAgregar(){
        $response = $this->call('GET', 'sector/preparacion/crear');
        $this->assertEquals(200, $response->status());
    }




}
