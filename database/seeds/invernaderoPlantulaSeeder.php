<?php

use Illuminate\Database\Seeder;
use App\invernaderoPlantula;

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
       // factory(App\invernaderoPlantula::class,1)->create();

        invernaderoPlantula::create(['nombre'=>'Invernadero plántula 1']);
    }
}
