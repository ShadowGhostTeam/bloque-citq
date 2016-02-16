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

    $siembras=  DB::table('siembraPlantula')->lists('id');
    $siembra=$faker->randomElement($siembras);
    $id_invernaderoPlantula=DB::table('siembraPlantula')->where('id', $siembra)->value('id_invernaderoPlantula');

    return [
        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'descripcion' => $faker->address,

        'id_invernaderoPlantula' => $id_invernaderoPlantula,
        'id_siembraPlantula'=>$siembra
    ];
});
