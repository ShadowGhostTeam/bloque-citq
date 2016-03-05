<?php

use Illuminate\Database\Seeder;

class laboresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\laboresCulturales::class,20)->create();
    }
}
