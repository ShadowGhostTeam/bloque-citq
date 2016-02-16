<?php

use Illuminate\Database\Seeder;

class siembraPlantulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            factory(App\siembraPlantula::class,10)->create();

    }
}
