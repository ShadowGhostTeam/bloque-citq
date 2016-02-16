<?php

use Illuminate\Database\Seeder;

class fertilizacionRiegoInvernaderoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\fertilizacionRiego::class,48)->create();
    }
}
