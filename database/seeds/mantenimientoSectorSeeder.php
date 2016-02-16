<?php

use Illuminate\Database\Seeder;

class mantenimientoSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\mantenimientoSector::class,20)->create();

    }
}
