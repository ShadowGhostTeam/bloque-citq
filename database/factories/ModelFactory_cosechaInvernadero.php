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

$factory->define(App\cosechaInvernadero::class, function (Faker\Generator $faker) {

    $siembraTransplanteInvernadero=  DB::table('siembraTransplanteInvernadero')->lists('id');




    return [
        'fecha'=>$faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        'descripcion' => $faker->address,
        //Se abrevio siembraTransplante a st porque el nombre era muy largo y sql no lo aceptaba
        'id_stInvernadero' =>$faker->randomElement($siembraTransplanteInvernadero),


    ];
});
