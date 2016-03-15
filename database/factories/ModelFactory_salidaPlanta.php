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

$factory->define(App\salidaPlanta::class, function (Faker\Generator $faker) {

    $siembraPlantula=  DB::table('siembra_plantula')->lists('id');
    $siembra=$faker->randomElement($siembraPlantula);
    $id_invernadero=DB::table('siembra_plantula')->where('id', $siembra)->value('id_invernaderoPlantula');
    return [
        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'comentario' => $faker->address,

        'id_invernaderoPlantula' => $id_invernadero,
        'id_siembraPlantula'=>$siembra
    ];
});
