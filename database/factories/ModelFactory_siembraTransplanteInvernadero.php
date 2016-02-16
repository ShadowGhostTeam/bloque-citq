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

$factory->define(App\siembraTransplanteInvernadero::class, function (Faker\Generator $faker) {
    $invernadero=  DB::table('invernadero')->lists('id');
    $cultivos=  DB::table('cultivo')->lists('id');
    return [

        'tipo'=> $faker->randomElement(['Siembra','Transplante']),
        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'fechaTerminacion'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'status' => $faker->randomElement(['Activo','Terminado']),
        'id_cultivo' => $faker->randomElement($cultivos),
        'id_invernadero' => $faker->randomElement($invernadero)
    ];
});

