<?php

use Faker\Generator as Faker;

$factory->define(App\Paciente::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido'=>$faker->lastName,
        'dni'=>$faker->randomNumber('8'),
        'fecha_nacimiento'=>$faker->dateTimeThisDecade('now', null),
        'telefono_contacto' => $faker->e164PhoneNumber,
        'barrio' => $faker->city,
        'direccion' => $faker->streetAddress,
        'email' =>$faker->email ,
    ];
});
