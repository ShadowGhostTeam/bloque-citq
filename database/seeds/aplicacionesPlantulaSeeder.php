<?php

use Illuminate\Database\Seeder;

class aplicacionesPlantulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\aplicacionesPlantula::class,20)->create();
    }
}
