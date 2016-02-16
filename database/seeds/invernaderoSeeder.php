<?php

use Illuminate\Database\Seeder;

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
        factory(App\invernadero::class,10)->create();
    }
}
