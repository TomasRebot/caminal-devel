<?php

use Illuminate\Database\Seeder;

class ProfesionalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Profesional::class,10)->create();
    }
}
