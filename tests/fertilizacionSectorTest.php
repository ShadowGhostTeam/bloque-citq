<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class fertilizacionSectorTest extends TestCase
{


    //////////////////////////////BUSCAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group fertilizacionBuscarSector

    /*Unidad*/
    /**
     * @group fertilizacionBuscarSector
     */
    public function testRutaBuscar(){
        $response = $this->call('GET', 'sector/fertilizacion');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarNoParametros(){
        $this->visit('sector/fertilizacion')
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarSectorCorrecto(){
        $this->visit('sector/fertilizacion')
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarFuenteCorrecto(){
        $this->visit('sector/fertilizacion')
            ->select(1,"fuente")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarFechaCorrecto(){
        $this->visit('sector/fertilizacion')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarSectorFechaCorrecto(){
        $this->visit('sector/fertilizacion')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"sector")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarFuenteFechaCorrecto(){
        $this->visit('sector/fertilizacion')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"fuente")
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarSectorFuenteFechaCorrecto(){
        $this->visit('sector/fertilizacion')
            ->type("29/02/2015","fechaInicio")
            ->type("29/02/2016","fechaFin")
            ->select(1,"sector")
            ->select(1,"fuente")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarUnaFecha(){
        $this->visit('sector/fertilizacion/lista?sector=&fuente=&fechaInicio=&fechaFin=29%2F02%2F2016')
            ->see("No se encontraron resultados");
    }

    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarUnaFechaTexto(){
        $this->visit('sector/fertilizacion/lista?sector=&fuente=&fechaInicio=sdfsdfsd&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarFechasTexto(){
        $this->visit('sector/fertilizacion/lista?sector=&fuente=&fechaInicio=sdfsdfsd&fechaFin=sdsdfd')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarSectorTexto(){
        $this->visit('sector/fertilizacion/lista?sector=asdasd&fuente=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarFuenteTexto(){
        $this->visit('sector/fertilizacion/lista?sector=&fuente=zfzfdf&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarSectorInexistente(){
        $this->visit('sector/fertilizacion/lista?sector=1000&fuente=&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }
    /**
     * @group fertilizacionBuscarSector
     */
    public function testBuscarFuenteInexistente(){
        $this->visit('sector/fertilizacion/lista?sector=&fuente=1000&fechaInicio=&fechaFin=')
            ->see("No se encontraron resultados");
    }







    ///////////////////////////////////////CREAR//////////////////////////////////////////////////////

    //para llamar a solo un grupo phpunit --group fertilizacionCrearSector

    /*Unidad*/
    /**
     * @group fertilizacionCrearSector
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'sector/fertilizacion/crear');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group fertilizacionCrearSector
     */
/*
    public function testCrearCorrecto(){
        $this->visit('sector/fertilizacion/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->select(1,"fuente")
            ->type("18/02/2016","fecha")
            ->select("Riego","tipoFertilizacion")
            ->type("2.5","cantidad")
            ->type("CREAR TEST","programaNPK")
            ->press('Crear')
            ->see("La preparacion ha sido agregada");
    }
*/
    /**
     * @group fertilizacionCrearSector
     */
  /*  public function testCrearNoSector(){
        $this->visit('sector/fertilzacion/crear')
            ->select(1,"siembra")
            ->select(1,"fuente")
            ->type("18/02/2016","fecha")
            ->select("Riego","tipoFertilizacion")
            ->type("2.5","cantidad")
            ->type("CREAR TEST","programaNPK")
            ->press('Crear')
            ->see("El campo sector es obligatorio");
    }
*/

    /**
     * @group fertilizacionCrearSector
     */

/*    public function testCrearNoSiembra(){
        $this->visit('sector/fertilizacion/crear')
            ->select(1,"sector")
            ->select(1,"fuente")
            ->type("18/02/2016","fecha")
            ->select("Riego","tipoFertilizacion")
            ->type("2.5","cantidad")
            ->type("CREAR TEST","programaNPK")
            ->press('Crear')
            ->see("El campo siembra es obligatorio");
    }
*/
    /**
     * @group fertilizacionCrearSector
     */
/*
    public function testCrearNoFuente(){
        $this->visit('sector/fertilizacion/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->type("18/02/2016","fecha")
            ->select("Riego","tipoFertilizacion")
            ->type("2.5","cantidad")
            ->type("CREAR TEST","programaNPK")
            ->press('Crear')
            ->see("El campo fuente es obligatorio");
    }
*/
    /**
     * @group fertilizacionCrearSector
     */
/*
    public function testCrearNoFecha(){
        $this->visit('sector/fertilizacion/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->select(1,"fuente")
            ->press('Crear')
            ->see("El campo fecha es obligatorio");
    }
*/
    /**
     * @group fertilizacionCrearSector
     */
  /*  public function testCrearNoCantidad(){
        $this->visit('sector/fertilizacion/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->select(1,"fuente")
            ->type("18/02/2016","fecha")
            ->select("Riego","tipoFertilizacion")
            ->type("CREAR TEST","programaNPK")
            ->press('Crear')
            ->see("La preparacion ha sido agregada");
    }

*/
    /**
     * @group fertilizacionCrearSector
     */
  /*  public function testCrearCantidadNegativo(){
        $this->visit('sector/fertilizacion/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->select(1,"fuente")
            ->type("18/02/2016","fecha")
            ->select("Riego","tipoFertilizacion")
            ->type("-1","cantidad")
            ->press('Crear')
            ->see("El tamaño de cantidad debe ser de al menos 0");
    }
    */
    /**
     * @group fertilizacionCrearSector
     */
    /*public function testCrearFechaIncorrecta(){
        $this->visit('sector/fertilizacion/crear')
            ->select(1,"sector")
            ->select(1,"siembra")
            ->select(1,"fuente")
            ->type("asdas","fecha")
            ->press('Crear')
            ->see("fecha no corresponde al formato d/m/Y");
    }*/



////////////////////////////////////////////////MODIFICAR/////////////////////////////////////////////////////////////////

//para llamar a solo un grupo "phpunit --group fertilizacionModificarSector"

    /*Unidad*/
    /**
     * @group fertilizacionModificarSector
     */
    /*public function testRutaModificar(){
        $response = $this->call('GET', 'sector/fertilizacion/modificar/12');
        $this->assertEquals(200, $response->status());
    }*/
    /**
     * @group fertilizacionModificarSector
     */
    /*public function testModificarIdIncorrecto(){
        $response = $this->call('GET', 'sector/fertilizacion/modificar/120');
        $this->assertEquals(404, $response->status());
    }*/
    /*Integración*/

    /**
     * @group fertilizacionModificarSector
     */

  /*  public function testModificarCorrecto(){
        $this->visit('sector/fertilizacion/modificar/12')
            ->select(1,"sector")
            ->select(1,"fuente")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Modificar')
            ->see("ha sido modificada");
    }
*/
    /**
     * @group fertilizacionModificarSector
     */

   /* public function testModificarNoSector(){
        $this->visit('sector/fertilizacion/modificar/12')
            ->select("","sector")
            ->select(1,"fuente")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Modificar')
            ->see("El campo sector es obligatorio");
    }*/
    /**
     * @group fertilizacionModificarSector
     */
  /*  public function testModificarNofuente(){
        $this->visit('sector/fertilizacion/modificar/12')
            ->select(1,"sector")
            ->select("","fuente")
            ->type("18/02/2016","fecha")
            ->type("2","numPasadas")
            ->press('Modificar')
            ->see("El campo fuente es obligatorio");
    }
*/
    /**
     * @group fertilizacionModificarSector
     */
/*
    public function testModificarNoFecha(){
        $this->visit('sector/fertilizacion/modificar/12')
            ->select(1,"sector")
            ->select(1,"fuente")
            ->type("2","numPasadas")
            ->type("","fecha")
            ->press('Modificar')
            ->see("El campo fecha es obligatorio");
    }
    */
    /**
     * @group fertilizacionModificarSector
     */

  /*  public function testModificarNoPasadas(){
        $this->visit('sector/fertilizacion/modificar/12')
            ->select(1,"sector")
            ->select(1,"fuente")
            ->type("","numPasadas")
            ->type("18/02/2016","fecha")
            ->press('Modificar')
            ->see("El campo número de pasadas es obligatorio");

    }
*/
    /**
     * @group fertilizacionModificarSector
     */
    /*public function testModificarPasadasNegativo(){
        $this->visit('sector/fertilizacion/modificar/12')
            ->select(1,"fuente")
            ->type("-1","numPasadas")
            ->press('Modificar')
            ->see("El tamaño de número de pasadas debe ser de al menos 0");
    }*/
    /**
     * @group fertilizacionModificarSector
     */
  /*  public function testModificarFechaIncorrecta(){
        $this->visit('sector/fertilizacion/modificar/12')
            ->select(1,"fuente")
            ->type("asdas","fecha")
            ->press('Modificar')
            ->see("fecha no corresponde al formato d/m/Y");
    }
*/




////////////////////////////////////////////////CONSULTAR/////////////////////////////////////////////////////////

//para llamar a solo un grupo "phpunit --group fertilizacionConsultarSector"

    /*Unidad*/
    /**
     * @group fertilizacionConsultarSector
     */
/*    public function testRutaConsultar(){
        $response = $this->call('GET', 'sector/fertilizacion/consultar/12');
        $this->assertEquals(200, $response->status());
    }
  */
    /**
     * @group fertilizacionConsultarSector
     */
    /*public function testConsultarIdIncorrecto(){
        $response = $this->call('GET', 'sector/fertilizacion/consultar/120');
        $this->assertEquals(404, $response->status());
    }
*/
}
