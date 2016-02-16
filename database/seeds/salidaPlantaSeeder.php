<?php

use Illuminate\Database\Seeder;

class salidaPlantaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\salidaPlanta::class,10)->create();

    }
}
