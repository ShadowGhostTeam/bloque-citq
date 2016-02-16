<?php

use Illuminate\Database\Seeder;

class maquinariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\maquinaria::class,10)->create();
    }
}
