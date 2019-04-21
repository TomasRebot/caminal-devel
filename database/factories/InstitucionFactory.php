<?php

use Faker\Generator as Faker;

$factory->define(App\Institucion::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'razon_social' => $faker->name,
        'cuit'=> $faker->randomNumber(9),
        'direccion'=> $faker->streetAddress,
        'telefono_contacto' => $faker->e164PhoneNumber,
        'apto_clearing' => $faker->randomElement(['si', 'no']),
    ];
});
