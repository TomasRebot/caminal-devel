<?php

use Faker\Generator as Faker;
use App\Medicamento;
$factory->define(App\Stock::class, function (Faker $faker) {

    return [
        'id_medicamento' =>$faker->randomElement(Medicamento::all()->pluck('id')->toArray()),
        'lote'=> $faker->randomLetter.$faker->randomLetter.''. $faker->randomNumber(3) ,
        'fecha_vencimiento'=> $faker->creditCardExpirationDate,
        'stock_caminal'=> $faker->numberBetween(0,150),
        'stock_remediar'=> $faker->numberBetween(0,150),

    ];
});
