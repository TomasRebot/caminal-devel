<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder

{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//$this->call(UsersTableSeeder::class);

        User::create([
            'name'=> 'Tomas rebot',
            'email'=> 'tomas.devel@gmail.com' ,
            'password'=> Hash::make('tomasito') ,
        ]);
        User::create([
            'name'=> 'Julio argentino roca',
            'email'=> 'julio.argentino@gmail.com' ,
            'password'=> Hash::make('tomasito') ,
        ]);
        User::create([
            'name'=> 'Ramon puerta',
            'email'=> 'ramon.puerta@gmail.com' ,
            'password'=> Hash::make('tomasito') ,
        ]);
        User::create([
            'name'=> 'Santiago Derqui',
            'email'=> 'santi.derqui@gmail.com' ,
            'password'=> Hash::make('tomasito') ,
        ]);
        User::create([
            'name'=> 'Miguel juarez celman',
            'email'=> 'migue.celman@gmail.com' ,
            'password'=> Hash::make('tomasito') ,
        ]);
        User::create([
            'name'=> 'Victorino de la plaza',
            'email'=> 'victo.rino@gmail.com' ,
            'password'=> Hash::make('tomasito') ,
        ]);
        $this->call(PacientesTableSeeder::class);
        $this->call(InstitucionesTableSeeder::class);
        $this->call(ProfesionalesTableSeeder::class);
        $this->call(MedicamentosTableSeeder::class);
        $this->call(StocksTableSeeder::class);
        $this->call(MovimientosTableSeeder::class);
        $this->call(DetallesTableSeeder::class);
    }
}
