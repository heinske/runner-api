<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Corredor extends Model
{

    public $table = 'corredores';
    public $timestamps = true;

    protected $fillable = [
        'nome', 
        'cpf',
        'data_nascimento'
    ];

    public function corridas()
    {
        return $this->hasMany('App\Model\Corrida', 'corredor_id', 'id');
    }
}
