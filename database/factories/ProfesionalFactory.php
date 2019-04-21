<?php

use Faker\Generator as Faker;

$factory->define(App\Profesional::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido'=>$faker->lastName,
        'dni'=>$faker->randomNumber('8'),
        'matricula'=>$faker->randomNumber('4'),
        'telefono_contacto' => $faker->e164PhoneNumber,
        'email' =>$faker->email ,
        'atiende_caminal' => $faker->randomElement(['si','no', NULL]),
        'direccion' => $faker->streetAddress,


    ];
});
