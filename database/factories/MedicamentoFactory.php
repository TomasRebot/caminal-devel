<?php

use Faker\Generator as Faker;

$factory->define(App\Medicamento::class, function (Faker $faker) {
    return [
        'codigo' => $faker->unique()->randomNumber(8),
        'nombre'=> $faker->name,
        'presentacion'=> $faker->word .' X '.$faker->randomNumber(3),
        'cantidad_blister'=> ($faker->randomDigitNotNull * 10),
        'cantidad_caja'=> ($faker->randomDigitNotNull * 10) ,

    ];
});
