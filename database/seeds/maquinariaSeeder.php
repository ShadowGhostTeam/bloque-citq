<?php

use Illuminate\Database\Seeder;
use App\maquinaria;

class maquinariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\maquinaria::class,10)->create();

        maquinaria::create(['nombre'=>'Tractor John Deere 5415']);
        maquinaria::create(['nombre'=>'Cuatrimoto (aspersora)']);
        maquinaria::create(['nombre'=>'Aspersora de mochila']);
        maquinaria::create(['nombre'=>'Remolque']);
        maquinaria::create(['nombre'=>'Rototiller']);
        maquinaria::create(['nombre'=>'Rastra de discos']);
        maquinaria::create(['nombre'=>'Subsuelo']);
        maquinaria::create(['nombre'=>'Compresor']);
        maquinaria::create(['nombre'=>'Máquina soldadora de arco']);
        maquinaria::create(['nombre'=>'Tanques de riego (invernaderos)']);
        maquinaria::create(['nombre'=>'Computadora de riego']);
        maquinaria::create(['nombre'=>'DripKit']);
        maquinaria::create(['nombre'=>'Sembradora Terramak']);
        maquinaria::create(['nombre'=>'Sembradora de granos finos']);
        maquinaria::create(['nombre'=>'Surcadora']);
        maquinaria::create(['nombre'=>'Acamadora']);
        maquinaria::create(['nombre'=>'Cultivadora']);
        maquinaria::create(['nombre'=>'Molino']);
        maquinaria::create(['nombre'=>'Cortadora']);
        maquinaria::create(['nombre'=>'Riel']);
        maquinaria::create(['nombre'=>'Acolchadora']);

    }
}









