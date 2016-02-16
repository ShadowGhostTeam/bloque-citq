<?php

use Illuminate\Database\Seeder;

class cosechaInvernaderoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\cosechaInvernadero::class,24)->create();
    }
}
