<?php

use Illuminate\Database\Seeder;

class preparacionSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\preparacionSector::class,48)->create();
    }
}
