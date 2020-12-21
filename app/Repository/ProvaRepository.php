<?php

namespace App\Repository;

use App\Model\Prova;

/**
 * Concentra as regras de negócio das provas
 * 
 * @author Eduardo Praxedes Heinske <praxeduardo@gmail.com>
 */
class ProvaRepository extends BaseRepository
{

    /**
     * Modelo de Prova
     *
     * @var Prova
     */
    protected $model;

    /**
     * Contrutor para injeção das dependências
     *
     * @param Prova $prova
     */
    public function __construct(Prova $prova)
    {
        $this->model = $prova;
    }

    

    
}
