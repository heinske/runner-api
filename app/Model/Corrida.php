<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Corrida extends Model
{

    public $table = 'corridas';
    public $timestamps = true;

    protected $fillable = [
       'prova_id',
       'corredor_id',
       'hora_inicio',
       'hora_termino'
    ];

    public function prova()
    {
        return $this->belongsTo('App\Model\Prova', 'prova_id', 'id');
    }

    public function corrida()
    {
        return $this->belongsTo('App\Model\Corrida', 'corredor_id', 'id');
    }

    

    
}
