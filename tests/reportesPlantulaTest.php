<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class reportesPlantulaTest extends TestCase
{
    /*Integracion*/

    /**
     * @group reportesPlantula
     */
    public function testRuta(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/plantula')
            ->seePageIs('reportes/plantula');
    }

    /*Unidad*/
    /**
     * @group reportesPlantula
     */

    public function testNoFechaInicio(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/plantula')
            ->press('Generar reporte')
            ->see('El campo fecha inicio es obligatorio.');
    }

    /**
     * @group reportesPlantula
     */
    public function testNoFechaFin(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/plantula')
            ->press('Generar reporte')
            ->see('El campo fecha fin es obligatorio.');
    }

    /**
     * @group reportesPlantula
     */
    public function testFechaFinInvalida(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/plantula')
            ->type("asdasd","fechaFin")
            ->press('Generar reporte')
            ->see('fecha fin no corresponde al formato d/m/Y.');
    }
    /**
     * @group reportesPlantula
     */
    public function testFechaInicioInvalida(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/plantula')
            ->type("asdasd","fechaInicio")
            ->press('Generar reporte')
            ->see('fecha inicio no corresponde al formato d/m/Y.');
    }


}
