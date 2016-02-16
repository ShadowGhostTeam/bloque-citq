<?php

use Illuminate\Database\Seeder;

class cosechaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\cosecha::class,24)->create();
    }
}
