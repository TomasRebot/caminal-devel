<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
        'telefono_contacto',
        'barrio',
        'direccion',
        'email',

    ];
    protected $table = "pacientes";



    public function movimientos()
    {
        return $this->hasMany('App\Movimiento', 'id_paciente', 'id');
    }

}
