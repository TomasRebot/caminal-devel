<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'presentacion',
        'cantidad_blister',
        'cantidad_caja',

    ];
    protected $table = "medicamentos";

    public function stocks()
    {
        return $this->hasMany('App\Stock', 'id_medicamento', 'id');
    }

}
