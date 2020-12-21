<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Prova extends Model
{

    /**
     * Tipos de Prova
     */
    const TIPOS = ['3', '5', '10', '21', '42'];

    public $table = 'provas';
    public $timestamps = true;

    protected $fillable = [
        'data', 
        'tipo'
    ];

    public function corridas()
    {
        return $this->hasMany('App\Model\Corrida', 'prova_id', 'id');
    }


}
