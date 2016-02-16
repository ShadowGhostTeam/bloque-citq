<?php

use Illuminate\Database\Seeder;

class siembraTransplanteInvernaderoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\siembraTransplanteInvernadero::class,24)->create();
    }
}
