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

$factory->define(App\riego::class, function (Faker\Generator $faker) {
    $siembras=  DB::table('siembra_sector')->lists('id');
    $siembra=$faker->randomElement($siembras);
    $id_sector=DB::table('siembra_sector')->where('id', $siembra)->value('id_sector');

    return [
        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'tiempo' => $faker->randomDigit,
        'id_siembra' =>$siembra,
        'id_sector'=>$id_sector
    ];
});

