<?php

use Illuminate\Database\Seeder;

class invernaderoPlantulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\invernaderoPlantula::class,1)->create();
    }
}
