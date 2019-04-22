<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'matricula',
        'telefono_contacto',
        'email',
        'atiende_caminal',
        'direccion',
        'estado',

    ];
    protected $table = "profesionales";

    public function movimientos()
    {
        return $this->hasMany('App\Movimiento', 'id_profesional', 'id');
    }
}
