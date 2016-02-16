<?php

use Illuminate\Database\Seeder;

class fertilizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\fertilizacion::class,48)->create();
    }
}
