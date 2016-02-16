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

$factory->define(App\preparacionPlantula::class, function (Faker\Generator $faker) {

    $invernadero=  DB::table('invernaderoPlantula')->lists('id');

    return [
        'charolas'=>$faker->randomDigit,
        'sustrato' => $faker->name,
        'fecha' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'id_invernaderoPlantula' => $faker->randomElement($invernadero)
    ];
});
