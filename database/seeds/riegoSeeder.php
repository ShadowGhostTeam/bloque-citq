<?php

use Illuminate\Database\Seeder;

class riegoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\riego::class,48)->create();
    }
}
