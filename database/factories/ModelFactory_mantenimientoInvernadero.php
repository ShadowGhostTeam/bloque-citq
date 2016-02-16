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

$factory->define(App\mantenimientoInvernadero::class, function (Faker\Generator $faker) {
    $siembraTransplanteInvernadero=  DB::table('siembraTransplanteInvernadero')->lists('id');


    return [

        'actividad'=> $faker->randomElement(['Deshojes', 'Despuntes','Brotes','Podas','Fungicidas','Herbicidas','Insecticida']),
        'producto' => $faker->name,
        'cantidad' => $faker->randomDigit,
        'tipoAplicacion'=> $faker->randomElement(['Sistema','Al suelo','Boli', 'Al follaje']),
        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'id_stInvernadero' =>$faker->randomElement($siembraTransplanteInvernadero),

    ];
});
