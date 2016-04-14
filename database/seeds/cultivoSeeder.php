<?php

use Illuminate\Database\Seeder;
use App\cultivo;

class cultivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  factory(App\cultivo::class,30)->create();

        cultivo::create(['nombre'=>'Tomate']);
        cultivo::create(['nombre'=>'Bell Pepper']);
        cultivo::create(['nombre'=>'Pepino']);
        cultivo::create(['nombre'=>'Habanero']);
        cultivo::create(['nombre'=>'Chile Jalapeño']);
        cultivo::create(['nombre'=>'Chile Serrano']);
        cultivo::create(['nombre'=>'Cebolla']);
        cultivo::create(['nombre'=>'Lechuga']);
        cultivo::create(['nombre'=>'Brócoli']);
        cultivo::create(['nombre'=>'Coliflor']);
        cultivo::create(['nombre'=>'Col China']);
        cultivo::create(['nombre'=>'Ajo']);
        cultivo::create(['nombre'=>'Fresa']);
        cultivo::create(['nombre'=>'Cilantro']);
        cultivo::create(['nombre'=>'Trigo']);
        cultivo::create(['nombre'=>'Sorgo']);
        cultivo::create(['nombre'=>'Maíz']);
        cultivo::create(['nombre'=>'Aguacate']);
        cultivo::create(['nombre'=>'Manzana']);
        cultivo::create(['nombre'=>'Guayaba']);
        cultivo::create(['nombre'=>'Pistache']);
        cultivo::create(['nombre'=>'Nogal']);
        cultivo::create(['nombre'=>'Limón']);

    }
}

