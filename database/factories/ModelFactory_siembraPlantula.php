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

$factory->define(App\siembraPlantula::class, function (Faker\Generator $faker) {
    $invernadero=  DB::table('invernadero_plantula')->lists('id');
    $cultivos=  DB::table('cultivo')->lists('id');
    return [

        'destino'=> $faker->randomElement(['Campo','Invernadero']),
        'contenedor'=> $faker->randomElement(['Maceta (1L)', 'Maceta (0.5L)', 'Maceta (0.25L)', 'Charola - Plástico', 'Charola - Unicel']),
        'numPlantas'=>$faker->randomDigit(),

        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'fechaTerminacion'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'variedad' => $faker->name,
        'sustrato' => $faker->name,
        'comentario' => $faker->name,
        'status' => $faker->randomElement(['Activo','Terminado']),
        'id_cultivo' => $faker->randomElement($cultivos),
        'id_invernaderoPlantula' => $faker->randomElement($invernadero)
    ];
});

