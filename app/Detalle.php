<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $fillable = [
        'destino',
        'id_stock',
        'id_movimiento',
        'cantidad',

    ];
    protected $table = "detalles";

    public function stock()
    {
        return $this->hasOne('App\Stock', 'id', 'id_stock');
    }

    public function movimiento()
    {
        return $this->belongsTo('App\Movimiento', 'id_movimiento');
    }

}
