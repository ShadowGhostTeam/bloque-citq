<?php

use Illuminate\Database\Seeder;

class aplicacionesMantenimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\aplicacionesMantenimiento::class,20)->create();
    }
}
