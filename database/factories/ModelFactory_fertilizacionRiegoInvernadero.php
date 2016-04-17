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

$factory->define(App\fertilizacionRiego::class, function (Faker\Generator $faker) {
    $siembraTransplanteInvernadero =  DB::table('siembra_invernadero')->lists('id');
    $siembra=$faker->randomElement($siembraTransplanteInvernadero);
    $id_invernadero=DB::table('siembra_invernadero')->where('id', $siembra)->value('id_invernadero');

    return [
        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'etapaFenologica' => $faker->randomElement(['Emergencia','Transplante','Crecimineto vegetativo','Fructificación','Senescencia']),
        'tiempoRiego' => $faker->randomDigit,
        'frecuencia' => $faker->randomDigit,
        'formulacion' => $faker->address,

        'id_stInvernadero' => $siembra,
        'id_invernadero'=>$id_invernadero
    ];
});
