<?php

use Illuminate\Database\Seeder;

class DetallesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Detalle::class,28)->create();

    }
}
