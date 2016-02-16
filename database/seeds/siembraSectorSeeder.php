<?php

use Illuminate\Database\Seeder;

class siembraSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\siembraSector::class,24)->create();
    }
}
