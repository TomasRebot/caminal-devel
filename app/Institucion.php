<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $fillable = [
        'nombre',
        'razon_social',
        'cuit',
        'direccion',
        'telefono_contacto',
        'apto_clearing'
    ];
    protected $table = "instituciones";


    public function movimientos()
    {
        return $this->hasMany('App\Movimiento', 'id_institucion', 'id');
    }
}
