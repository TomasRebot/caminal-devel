<?php

use Faker\Generator as Faker;
use App\Stock;
use App\Movimiento;
$factory->define(App\Detalle::class, function (Faker $faker) {
    return [
        'destino' =>$faker->randomElement(['caminal','remediar']) ,
        'id_stock'=>$faker->randomElement(Stock::all()->pluck('id')->toArray()),
        'id_movimiento'=>$faker->randomElement(Movimiento::all()->pluck('id')->toArray()),
        'cantidad' =>$faker->numberBetween(1,60),
    ];
});
