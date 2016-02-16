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

$factory->define(App\siembraSector::class, function (Faker\Generator $faker) {
    $sectores=  DB::table('sector')->lists('id');
    $cultivos=  DB::table('cultivo')->lists('id');
    return [
    'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'tipo'=> $faker->randomElement(['Maquinaria','A mano']),
        'temporada'=> $faker->randomElement(['Primavera-Verano','Otoño-Invierno']),
        'status'=> $faker->randomElement(['Activo','Terminado']),
        'fechaTerminacion'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'id_sector' => $faker->randomElement($sectores),
        'id_cultivo' => $faker->randomElement($cultivos)
    ];
});

