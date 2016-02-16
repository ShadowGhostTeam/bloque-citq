<?php

use Illuminate\Database\Seeder;

class sectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\sector::class,12)->create();
    }
}
