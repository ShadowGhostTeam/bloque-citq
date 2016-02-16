<?php

use Illuminate\Database\Seeder;

class preparacionInvernaderoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\preparacionInvernadero::class,10)->create();
    }
}
