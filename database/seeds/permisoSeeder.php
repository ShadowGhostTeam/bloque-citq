<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;

class permisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sector=Permission::create([
            'name' => 'sector',
            'slug' => 'sector',
            'description' => 'Modulo sector', // optional
        ]);

        $invernadero=Permission::create([
            'name' => 'invernadero',
            'slug' => 'invernadero',
            'description' => 'Modulo sector', // optional
        ]);

        $invernaderoPlantula=Permission::create([
            'name' => 'invernaderoPlantula',
            'slug' => 'invernaderoPlantula',
            'description' => 'Modulo invernadero', // optional
        ]);

        $reportes=Permission::create([
            'name' => 'reportes',
            'slug' => 'reportes',
            'description' => 'Modulo invernaderoPlantula', // optional
        ]);

        $administracion=Permission::create([
            'name' => 'administracion',
            'slug' => 'administracion',
            'description' => 'Modulo administracion sin gestion usuarios', // optional
        ]);

        $gestionarUsuarios=Permission::create([
            'name' => 'gestionarUsuarios',
            'slug' => 'gestionarUsuarios',
            'description' => 'Gestion usuarios', // optional
        ]);

        $administrador = Role::find(1);
        $tecnico = Role::find(2);
        $becario = Role::find(3);

        $administrador->attachPermission($sector);
        $administrador->attachPermission($invernadero);
        $administrador->attachPermission($invernaderoPlantula);
        $administrador->attachPermission($administracion);
        $administrador->attachPermission($reportes);
        $administrador->attachPermission($gestionarUsuarios);

        $tecnico->attachPermission($sector);
        $tecnico->attachPermission($invernadero);
        $tecnico->attachPermission($invernaderoPlantula);
        $tecnico->attachPermission($administracion);
        $tecnico->attachPermission($reportes);

        $becario->attachPermission($sector);
        $becario->attachPermission($invernadero);
        $becario->attachPermission($invernaderoPlantula);
        $becario->attachPermission($administracion);



    }
}
