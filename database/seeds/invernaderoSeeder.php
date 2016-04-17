<?php

use Illuminate\Database\Seeder;
use App\invernadero;

class invernaderoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       // factory(App\invernadero::class,4)->create();

        invernadero::create(['nombre'=>'Invernadero 1']);
        invernadero::create(['nombre'=>'Invernadero 2']);
        invernadero::create(['nombre'=>'Invernadero 3']);
        invernadero::create(['nombre'=>'Invernadero 4']);

    }
}
