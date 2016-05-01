<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //sector

        $this->call('cultivoSeeder');
        $this->call('maquinariaSeeder');

        $this->call('sectorSeeder');
        $this->call('preparacionSectorSeeder');
        $this->call('siembraSectorSeeder');
        $this->call('riegoSeeder');
        $this->call('fertilizacionSeeder');
        $this->call('mantenimientoSectorSeeder');
        $this->call('cosechaSeeder');


        //invernadero


        $this->call('invernaderoSeeder');
        $this->call('siembraTransplanteInvernaderoSeeder');
        $this->call('cosechaInvernaderoSeeder');
        $this->call('preparacionInvernaderoSeeder');
        $this->call('laboresSeeder');
        $this->call('aplicacionesMantenimientoSeeder');
        $this->call('fertilizacionRiegoInvernaderoSeeder');

        //invernadero plantula

        $this->call('invernaderoPlantulaSeeder');
        $this->call('siembraPlantulaSeeder');
        $this->call('aplicacionesPlantulaSeeder');
        $this->call('riegoPlantulaSeeder');
        $this->call('salidaPlantaSeeder');

        //RBAC
        $this->call('usuariosSeeder');
        $this->call('rolesSeeder');
        $this->call('permisoSeeder');


        Model::reguard();
    }
}
