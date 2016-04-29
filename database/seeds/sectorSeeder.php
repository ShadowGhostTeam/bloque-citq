<?php

use Illuminate\Database\Seeder;
use App\sector;

class sectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // factory(App\sector::class,12)->create();
        sector::create(['nombre'=>'Sector 1']);
        sector::create(['nombre'=>'Sector 2']);
        sector::create(['nombre'=>'Sector 3']);
        sector::create(['nombre'=>'Sector 4']);
        sector::create(['nombre'=>'Sector 5']);
        sector::create(['nombre'=>'Sector 6']);
        sector::create(['nombre'=>'Sector 7']);
        sector::create(['nombre'=>'Sector 8']);
        sector::create(['nombre'=>'Sector 9']);
        sector::create(['nombre'=>'Sector 10']);
        sector::create(['nombre'=>'Sector 11']);
        sector::create(['nombre'=>'Sector 12']);

        sector::create(['nombre'=>'Oficina']);
        sector::create(['nombre'=>'Áreas verdes invernaderos']);
        sector::create(['nombre'=>'Nogales']);
        sector::create(['nombre'=>'Manzanos']);
        sector::create(['nombre'=>'Pistaches']);
        sector::create(['nombre'=>'Guayabos']);
        sector::create(['nombre'=>'Aguacates']);
        sector::create(['nombre'=>'Limones']);
        sector::create(['nombre'=>'Huerto']);


    }
}
