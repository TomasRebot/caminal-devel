<?php

use Faker\Generator as Faker;
use App\Institucion;
use App\Profesional;
use App\Paciente;
use App\User;
$factory->define(App\Movimiento::class, function (Faker $faker) {
    return [
        'tipo'=> $faker->randomElement(['alta', 'baja']),
        'remito'=> $faker->randomNumber(6),
        'id_usuario'=> $faker->randomElement(User::all()->pluck('id')->toArray()),
        'id_paciente'=> $faker->randomElement(Paciente::all()->pluck('id')->toArray()),
        'id_profesional'=> $faker->randomElement(Profesional::all()->pluck('id')->toArray()),
        'id_institucion'=> $faker->randomElement(Institucion::all()->pluck('id')->toArray()),

    ];
});
