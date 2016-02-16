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
use App\siembraSector;

$factory->define(App\fertilizacionRiego::class, function (Faker\Generator $faker) {

    $siembraTransplanteInvernadero =  DB::table('siembraTransplanteInvernadero')->lists('id');

    return [
        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'etapaFenologica' => $faker->randomElement(['Etapa1']),
        'tiempoRiego' => $faker->randomDigit,
        'frecuencia' => $faker->randomDigit,
        'formulacion' => $faker->address,

        'id_stInvernadero' => $faker->randomElement($siembraTransplanteInvernadero)
    ];
});
