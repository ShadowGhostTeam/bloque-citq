<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
    public function testRuta()
    {
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/sector')
            ->seePageIs('reportes/sector');
    }

    /*Unidad*/
    /**
     * @group reportesSector
     */
    public function testNoSectorNoCultivo()
    {
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('reportes/sector')
            ->press('Generar reporte')
            ->see('Elija un sector y/o cultivo');
    }


}
