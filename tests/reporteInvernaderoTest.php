<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class reporteInvernaderoTest extends TestCase
{

    /*Integracion*/

    /**
     * @group reportesInvernadero
     */
    public function testRuta(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/invernadero')
            ->seePageIs('reportes/invernadero');
    }

    /*Unidad*/
    /**
     * @group reportesInvernadero
     */

    public function testNoFechaInicio(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/invernadero')
            ->press('Generar reporte')
            ->see('El campo fecha inicio es obligatorio.');
    }

    /**
     * @group reportesInvernadero
     */
    public function testNoFechaFin(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/invernadero')
            ->press('Generar reporte')
            ->see('El campo fecha fin es obligatorio.');
    }

    /**
     * @group reportesInvernadero
     */
    public function testFechaFinInvalida(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/invernadero')
            ->type("asdasd","fechaFin")
            ->press('Generar reporte')
            ->see('fecha fin no corresponde al formato d/m/Y.');
    }

    /**
     * @group reportesInvernadero
     */
    public function testFechaInicioInvalida(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/invernadero')
            ->type("asdasd","fechaInicio")
            ->press('Generar reporte')
            ->see('fecha inicio no corresponde al formato d/m/Y.');
    }




}
