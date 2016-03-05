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

$factory->define(App\laboresCulturales::class, function (Faker\Generator $faker) {
    $siembraTransplanteInvernadero =  DB::table('siembraTransplanteInvernadero')->lists('id');
    $siembra=$faker->randomElement($siembraTransplanteInvernadero);
    $id_invernadero=DB::table('siembraTransplanteInvernadero')->where('id', $siembra)->value('id_invernadero');


    return [

        'actividad'=> $faker->randomElement(['Deshojes', 'Despuntes','Brotes','Podas']),
        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),

        'id_stInvernadero' => $siembra,
        'id_invernadero'=>$id_invernadero

    ];
});
