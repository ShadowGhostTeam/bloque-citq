<?php

use Illuminate\Database\Seeder;

class riegoPlantulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\riegoPlantula::class,20)->create();
    }
}
