<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class reportesSectorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /*Integracion*/

    /**
     * @group reportesSector
     */
    public function testRuta(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/sector')
            ->seePageIs('reportes/sector');
    }

    /*Unidad*/


    /*Unidad*/
    /**
     * @group reportesSector
     */

    public function testNoFechaInicio(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/sector')
            ->press('Generar reporte')
            ->see('El campo fecha inicio es obligatorio.');
    }

    /**
     * @group reportesSector
     */
    public function testNoFechaFin(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/sector')
            ->press('Generar reporte')
            ->see('El campo fecha fin es obligatorio.');
    }

    /**
     * @group reportesSector
     */
    public function testFechaFinInvalida(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/sector')
            ->type("asdasd","fechaFin")
            ->press('Generar reporte')
            ->see('fecha fin no corresponde al formato d/m/Y.');
    }

    /**
     * @group reportesSector
     */
    public function testFechaInicioInvalida(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/sector')
            ->type("asdasd","fechaInicio")
            ->press('Generar reporte')
            ->see('fecha inicio no corresponde al formato d/m/Y.');
    }


}
