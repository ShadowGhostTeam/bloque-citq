<?php

use Illuminate\Database\Seeder;

class preparacionPlantulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\preparacionPlantula::class,10)->create();

    }
}
