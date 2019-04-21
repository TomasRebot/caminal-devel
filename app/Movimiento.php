<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = [
        'tipo',
        'remito',
        'id_usuario',
        'id_paciente',
        'id_profesional',
        'id_institucion',

    ];
    protected $table = "movimientos";

    public function detalles()
    {
        return $this->hasMany('App\Detalle', 'id_movimiento', 'id');
    }
    public function paciente()
    {
        return $this->belongsTo('App\Paciente', 'id_paciente', 'id');
    }
    public function institucion()
    {
        return $this->belongsTo('App\Institucion', 'id_institucion', 'id');
    }
    public function profesional()
    {
        return $this->belongsTo('App\Profesional', 'id_profesional', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'id_usuario', 'id');
    }





}
