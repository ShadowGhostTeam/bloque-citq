<?php

use Illuminate\Database\Seeder;

class mantenimientoInvernaderoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\mantenimientoInvernadero::class,20)->create();
    }
}
