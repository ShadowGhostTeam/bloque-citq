<?php

use Illuminate\Database\Seeder;

class cultivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\cultivo::class,30)->create();
    }
}
