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

$factory->define(App\mantenimientoSector::class, function (Faker\Generator $faker) {
    $siembras=  DB::table('siembraSector')->lists('id');
    $siembra=$faker->randomElement($siembras);
    $id_sector=DB::table('siembraSector')->where('id', $siembra)->value('id_sector');

    return [
        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'actividad'=> $faker->randomElement(['Deshierbe manual', 'Deshierbe máquina','Fungicida','Herbicida','Insecticida']),
        'tipoAplicacion'=> $faker->randomElement(['Sistema','Al suelo', 'Al follaje']),
        'cantidad' => $faker->randomDigit,
        'producto' => $faker->name,

        'id_siembra' =>$siembra,
        'id_sector'=>$id_sector
    ];
});

