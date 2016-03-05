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
use App\siembraTransplanteInvernadero;

$factory->define(App\riegoPlantula::class, function (Faker\Generator $faker) {

    $siembraPlantula=  DB::table('siembraPlantula')->lists('id');
    $siembra=$faker->randomElement($siembraPlantula);
    $id_invernadero=DB::table('siembraPlantula')->where('id', $siembra)->value('id_invernaderoPlantula');

    return [
        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'tiempoRiego' => $faker->randomDigit,
        'frecuencia' => $faker->randomDigit,
        'formulacion' => $faker->address,

        'id_siembraPlantula' => $siembra,
        'id_invernaderoPlantula'=>$id_invernadero
    ];
});
