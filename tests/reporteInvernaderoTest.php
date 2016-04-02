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




}
