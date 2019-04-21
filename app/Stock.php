<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'id_medicamento',
        'lote',
        'fecha_vencimiento',
        'stock_caminal',
        'stock_remediar',

    ];
    protected $table = "stocks";


    public function detalles()
    {
        return $this->hasMany('App\Detalle', 'id_stock', 'id');
    }

    public function medicamento()
    {
        return $this->hasOne('App\Medicamento', 'id', 'id_medicamento');
    }



}
