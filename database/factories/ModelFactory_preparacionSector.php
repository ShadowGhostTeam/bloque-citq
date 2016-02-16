<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\preparacionSector::class, function (Faker\Generator $faker) {
    $sectores=  DB::table('sector')->lists('id');
    $maquinarias=  DB::table('maquinaria')->lists('id');
    return [
        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'numPasadas' => $faker->randomDigit,
        'id_sector' => $faker->randomElement($sectores),
        'id_maquinaria' => $faker->randomElement($maquinarias)
    ];
});

