<?php

namespace App\Repository;

use App\Model\Corredor;

/**
 * Concentra as regras de negócio dos corredores
 * 
 * @author Eduardo Praxedes Heinske <praxeduardo@gmail.com>
 */
class CorredorRepository extends BaseRepository
{

    /**
     * Modelo de corredor
     *
     * @var Corredor
     */
    protected $model;

    /**
     * Contrutor para injeção das dependências
     *
     * @param Corredor $corredor
     */
    public function __construct(Corredor $corredor)
    {
        $this->model = $corredor;
    }

    



    
}
